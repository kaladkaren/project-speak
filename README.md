# Project Speak API
[![Bless](https://cdn.rawgit.com/LunaGao/BlessYourCodeTag/master/tags/sakyamuni.svg)](http://lunagao.github.io/BlessYourCodeTag/)
[![Bless](https://cdn.rawgit.com/LunaGao/BlessYourCodeTag/master/tags/fsm.svg)](http://lunagao.github.io/BlessYourCodeTag/)

## Table of contents
1. [Register device ID](#register-device-id)
1. [Members](#members)
    1. [Get all internal members](#get-all-internal-members) 🆗
1. [Divisions](#divisions)
    1. [Get all divisions](#get-all-divisions)
1. [Departments](#departments)
    1. [Get all departments](#get-all-departments) 🆗
1. [Sub agencies](#sub-agencies)
    1. [Get all sub agencies](#get-all-sub-agencies)
    1. [Get all sub agencies by department id](#get-all-sub-agencies-by-department-id) 🆗
1. [Rateables](#rateables)
    1. [Get all services](#get-all-services)
    1. [Get all experience](#get-all-experience)
    1. [Get all people](#get-all-people)
1. [Ratings](#ratings)
    1. [Sync](#sync) 🆗


---


### Register device ID
POST `/devices`  
**NOTE:** At the very first launch of the app, the device ID should be sent to the API. This is used to differentiate `experience`, `services`, and `people` from other stations

##### Payload

|      Name      | Required |   Type    |    Description    |    Sample Data 
|----------------|----------|-----------|-------------------|-----------------------
|    device_id   |  yes     |  string   |        -          |    1234asdzxcvbn 
|  device_name   |  yes     |  string   | name of the device that will appear in admin backend | HR's tablet


##### Response
```javascript
200 OK

{
	"data" : {
	    "id": "2",
	    "device_id": "a123qweasdzxc",
	    "device_name": "Enzo's device",
	    "created_at": "2019-06-28 17:54:50",
	    "updated_at": "0000-00-00 00:00:00"
	},
	"meta" : {
		"message": "Successfully registered device",
		"status": 200,
		"code": "ok"
	}
}

// if existing
200 OK
{
	"data" : {},
	"meta" : {
		"message": "Device already registered before",
		"status": 200,
		"code": "already_exists"
	}
}
```

## Members
### Get all internal members  
GET `/members/internal`

##### Response
```javascript
200 OK

{
  "data": [
    {
      "id": "1",
      "full_name": "Lorenzo Dante",
      "division_id": "1",
      "created_at": "2019-07-05 17:53:42",
      "updated_at": "0000-00-00 00:00:00"
    },
    {
      "id": "2",
      "full_name": "En Dan",
      "division_id": "2",
      "created_at": "2019-07-05 17:53:42",
      "updated_at": "0000-00-00 00:00:00"
    },
    {
      "id": "3",
      "full_name": "Endan Pendleton",
      "division_id": "1",
      "created_at": "2019-07-05 17:53:42",
      "updated_at": "0000-00-00 00:00:00"
    }
  ],
  "meta": {
    "message": "Got all data",
    "status": 200,
    "code": "ok"
  }
}
```

## Divisions
### Get all divisions
GET `/divisions`

##### Response
```javascript
200 OK

{
	"data" : [
		{"id": 1, "name":"Division 1"},
		{"id": 2, "name":"Division 2"},
		{"id": 3, "name":"Division 3"},
		{"id": 4, "name":"Division 4"}
	],
	"meta":{
		"message":"Got all data",
		"status": 200,
		"code": "ok"
		"station": {
			"station_id": 1,
			"station_name": "First floor station"
		}
	}
}
```

## Departments 
### Get all departments
GET `/departments`

##### Response
```javascript
200 OK

{
  "data": [
    {
      "id": "1",
      "department_name": "Anti Cybercrime Department",
      "created_at": "2019-07-05 17:53:44",
      "updated_at": "0000-00-00 00:00:00"
    },
    {
      "id": "2",
      "department_name": "Food and Drugs Department",
      "created_at": "2019-07-05 17:53:44",
      "updated_at": "0000-00-00 00:00:00"
    },
    {
      "id": "3",
      "department_name": "Department of Tourism",
      "created_at": "2019-07-05 17:53:45",
      "updated_at": "0000-00-00 00:00:00"
    },
    {
      "id": "4",
      "department_name": "Help Department",
      "created_at": "2019-07-05 17:53:45",
      "updated_at": "0000-00-00 00:00:00"
    }
  ],
  "meta": {
    "message": "Got all data",
    "status": 200,
    "code": "ok"
  }
}
```

## Sub agencies
### Get all sub agencies
GET `/sub_agencies`

##### Response
```javascript
200 OK

{
	"data" : [
		{"id":1, "department_id":1, "name":"Sub agency 1"},
		{"id":2, "department_id":2, "name":"Sub agency 2"},
		{"id":3, "department_id":2, "name":"Sub agency 3"},
		{"id":4, "department_id":3, "name":"Sub agency 4"}
	],
	"meta":{
		"message":"Got all data",
		"status": 200,
		"code": "ok"
		"station": {
			"station_id": 1,
			"station_name": "First floor station"
		}
	}
}
```


### Get all sub agencies by department id
GET `/sub_agencies/department/:department_id`

##### Response
```javascript
200 OK

{
  "data": [
    {
      "id": "1",
      "agency_name": "Anti-drugs division",
      "department_id": "1",
      "created_at": "2019-07-05 16:30:20",
      "updated_at": "0000-00-00 00:00:00"
    },
    {
      "id": "2",
      "agency_name": "Anti-terrorism division",
      "department_id": "1",
      "created_at": "2019-07-05 16:30:20",
      "updated_at": "0000-00-00 00:00:00"
    }
  ],
  "meta": {
    "message": "Got all data",
    "status": 200,
    "code": "ok",
    "station": {
      "station_id": "1",
      "station_name": "Delhatti Spire"
    }
  }
}
```


---



# Important Note  
All endpoints that follow *MUST* include a `DEVICE-ID` header with the value of the requester's device ID. Otherwise, the API will respond a forbidden error.

##### Response
```javascript
403 Forbidden

{
	"data" : {},
	"meta" : {
		"message": "A station has yet to be assigned to your Device ID. Please contact your administrator for more details.",
		"status": 403,
		"code": "forbidden"
	}
}
```

If the device id is not yet registered, the message will change.  

##### Response
```javascript
403 Forbidden

{
	"data" : {},
	"meta" : {
		"message": "Device ID not yet registered.",
		"status": 403,
		"code": "forbidden"
	}
}
```

## Rateables

### Get all experience
GET `/rateables/experience`

##### Response
```javascript
200 OK

{
	"data" : [
		{
			"id":2,
			"name": "Gold Experience", 
			"description":"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
			"type": "experience",
			"image_file": "lorem.jpeg",
	    },
	    {
			"id":3,
			"name": "Silver Chariot", 
			"description":"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
			"type": "experience",
			"image_file": "lorem.jpeg",
	    }
	],
	"meta":{
		"message":"Got all data",
		"status": 200,
		"code": "ok"
		"station": {
			"station_id": 1,
			"station_name": "First floor station"
		}
	}
}
```

### Get all services
GET `/rateables/services`

##### Response
```javascript
200 OK

{
	"data" : [
		{
			"id":2,
			"name": "Service of the Requiem", 
			"description":"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
			"type": "services",
			"image_file": "lorem.jpeg",
	    },
	    {
			"id":3,
			"name": "An Ode to the Melody", 
			"description":"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
			"type": "services",
			"image_file": "lorem.jpeg",
	    }
	],
	"meta":{
		"message":"Got all data",
		"status": 200,
		"code": "ok"
		"station": {
			"station_id": 1,
			"station_name": "First floor station"
		}
	}
}
```

## Rateables
### Get all people
GET `/rateables/people`

##### Response
```javascript
200 OK

{
	"data" : [
		{
			"id":2,
			"name": "Godfrey Fvjyana", 
			"description":"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
			"type": "people",
			"image_file": "lorem.jpeg",
	    },
	    {
			"id":2,
			"name": "Seyn Daerz", 
			"description":"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
			"type": "people",
			"image_file": "lorem.jpeg",
	    }
	],
	"meta":{
		"message":"Got all data",
		"status": 200,
		"code": "ok"
		"station": {
			"station_id": 1,
			"station_name": "First floor station"
		}
	}
}
```


---


## Ratings 
### Sync
POST `/ratings/sync`  

##### Payload

|      Name              |  Required  |  Type     |           Description            |    Sample Data 
|------------------------|------------|-----------|----------------------------------|------------------ 
|  rateable_id           | yes        | number    | id of the one you will rate      |        1 
|  saved_station_id      | yes        | number    | saved station ID at the time of rating  |        1 
|  rating                | yes        | number    | rating  1 (lowest) - 5 (highest) |        5 
|  rated_at              | yes        | datetime  | time of rating on local device   | 2019-11-29 23:23:23
|  internal_member_id    | optional   | number    | if blank, will assume the request is from an external member | 123 / 0 / null
| **- beyond this row are the parameters  used for external  member ratings. omit them if you have internal_member_id -**
|  external_member_name  | optional   | string    | name of the external member      | 'John Doe'
|  department_id         | optional   | number    | department id of the external member | 1 
|  sub_agency_id         | optional   | number    | sub agency id of the external member | 2

##### Response
```javascript
200 OK

{
	"data" : {},
	"meta" : {
		"message": "Sync success",
		"status": 200,
		"code": "ok"
	}
}
```