# Project Speak API
[![Bless](https://cdn.rawgit.com/LunaGao/BlessYourCodeTag/master/tags/sakyamuni.svg)](http://lunagao.github.io/BlessYourCodeTag/)
[![Bless](https://cdn.rawgit.com/LunaGao/BlessYourCodeTag/master/tags/fsm.svg)](http://lunagao.github.io/BlessYourCodeTag/)

## Table of contents

|     Resource      |                         Route                         |    Needs `Device-Id` header     | Status | Recently modified  
|-------------------|-------------------------------------------------------|------------------------------------|--------|--------------------
| Devices           | [Register device ID](#register-device-id)             |                  no                | 🆗    | 
| Members           | [Get all internal members](#get-all-internal-members) |                  no                | 🆗    | 
| Divisions         | [Get all divisions](#get-all-divisions)               |                  no                | 🆗    | 
| Departments       | [Get all departments](#get-all-departments)           |                  no                | 🆗    | 
| Sub agencies      | [Get all sub agencies](#get-all-sub-agencies)         |                  no                |  🆗   | 
| Sub agencies      | [Get all sub agencies by department id](#get-all-sub-agencies-by-department-id) |          no            |  🆗   | 
| Options **(UPDATED)** | [Check rateables & groups status](#check-rateables--groups-status)     |                  no                |  🆗    | Aug 6, 2019 11:00 AM
| Rateables         | [Get all services](#get-all-services)                 |                  **yes**           |  🆗    | Aug 16, 2019 9:32 AM
| Rateables         | [Get all mixed services](#get-all-mixed-services)                 |                  **yes**           |  🆗    | Aug 16, 2019 9:32 AM
| Rateables         | [Get all experience](#get-all-experience)             |                  **yes**           |  🆗    | Aug 16, 2019 9:32 AM 
| Rateables         | [Get all people](#get-all-people)                     |                  **yes**           |  🆗    | Aug 16, 2019 9:32 AM
| Ratings           | [Sync](#sync)                                         |                  **yes**           |  🆗    | 

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
  "data": [
    {
      "id": "1",
      "division_name": "Scotland Yard",
      "created_at": "2019-07-05 17:53:43",
      "updated_at": "0000-00-00 00:00:00"
    },
    {
      "id": "2",
      "division_name": "KPD",
      "created_at": "2019-07-05 17:53:43",
      "updated_at": "0000-00-00 00:00:00"
    },
    {
      "id": "3",
      "division_name": "Morioh Police",
      "created_at": "2019-07-05 17:53:43",
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
  "data": [
    {
      "id": "1",
      "agency_name": "Anti-drugs division",
      "department_id": "1",
      "created_at": "2019-07-09 16:20:49",
      "updated_at": "0000-00-00 00:00:00",
      "department_name": "Anti Cybercrime Department"
    },
    {
      "id": "2",
      "agency_name": "Anti-terrorism division",
      "department_id": "1",
      "created_at": "2019-07-09 16:20:49",
      "updated_at": "0000-00-00 00:00:00",
      "department_name": "Anti Cybercrime Department"
    },
    {
      "id": "3",
      "agency_name": "AA Example agency",
      "department_id": "4",
      "created_at": "2019-07-09 16:20:49",
      "updated_at": "2019-07-18 11:13:30",
      "department_name": "Help Department"
    }
  ],
  "meta": {
    "message": "Got all data",
    "status": 200,
    "code": "ok"
  }
}
```


---
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
      "created_at": "2019-07-05 17:53:45",
      "updated_at": "0000-00-00 00:00:00"
    },
    {
      "id": "2",
      "agency_name": "Anti-terrorism division",
      "department_id": "1",
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

---
### Check rateables & groups status  
Checks if there is an updated rateable or group  
POST `/options/updated-items`  

|      Name      | Required |   Type    |    Description    |    Sample Data 
|----------------|----------|-----------|-------------------|-----------------------
|    device_id   |  yes     |  string   |        -          |    1234asdzxcvbn 
| last_updated   |  yes     |  string   | local datetime last updated on the device | 2019-08-11 00:00:00

##### Response
```javascript
200 OK
{
  "data": {
    "rateables": {
      "items": [
        {
          "type": "services",
          "is_updated": false
        },
        {
          "type": "experience",
          "is_updated": false
        },
        {
          "type": "people",
          "is_updated": false
        }
      ],
      "is_reassigned": false // if the rateables have changed order/or have been reassigned.
       //if this is true, then it is necessary to call all rateable endpoints regardless if they are updated or not
    },
    "generic": {
      "items": [
        {
          "type": "internal_members",
          "is_updated": false
        },
        {
          "type": "divisions",
          "is_updated": false
        },
        {
          "type": "departments",
          "is_updated": true
        },
        {
          "type": "sub_agencies",
          "is_updated": false
        }
      ]
    }
  },
  "meta": {
    "message": "Got all data",
    "status": 200,
    "code": "ok",
    "datetime": "2019-08-06 10:59:01"
  },
  "request_meta": {
    "device_id": "sphinxofblackquartzjudgemyvow",
    "station_id": "1",
    "last_updated": "2019-07-30 17:18:55"
  }
}
```

In the event of a failure...  
```javascript
200 OK

{
  "data" : {},
  "meta" : {
    "message": "Device ID is not yet registered.",
    "status": 200,
    "code": "not_registered"
  }
}
```

```javascript
200 OK

{
  "data" : {},
  "meta" : {
    "message": "A station has yet to be assigned to your Device ID. Please contact your administrator for more details.",
    "status": 200,
    "code": "not_assigned"
  }
}
```

---

# Important Note  
All endpoints that follow *MUST* include a `Device-Id` header with the value of the requester's device ID. Otherwise, the API will respond a forbidden error.

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
  "data": [
    {
      "id": "6",
      "name": "Gold Experience",
      "sub_name": null,
      "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
      "division_id": "0",
      "type": "experience",
      "image_file": "https:\/\/robohash.org\/1562660451.png?set=set2",
      "created_at": "2019-07-09 16:20:50",
      "updated_at": "0000-00-00 00:00:00",
      "division_name": "Unclassified",
      "image_url": "https:\/\/robohash.org\/1562660451.png?set=set2"
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

### Get all services
GET `/rateables/services`

##### Response
```javascript
200 OK

{
  "data": [
    {
      "id": "3",
      "name": "Woodworking",
      "sub_name": null,
      "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
      "division_id": "0",
      "type": "services",
      "image_file": "https:\/\/robohash.org\/1562660452.png?set=set1",
      "created_at": "2019-07-09 16:20:50",
      "updated_at": "0000-00-00 00:00:00",
      "division_name": "Unclassified",
      "image_url": "https:\/\/robohash.org\/1562660452.png?set=set1"
    },
    {
      "id": "26",
      "name": "Serbisyong totoo",
      "sub_name": "Hey!!!",
      "description": "",
      "division_id": "2",
      "type": "services",
      "image_file": "1565935022_octocat.png",
      "created_at": "2019-08-16 13:42:43",
      "updated_at": "2019-08-16 13:57:02",
      "division_name": "KPD",
      "image_url": "http:\/\/localhost\/project-speak\/uploads\/rateables\/1565935022_octocat.png"
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

### Get all mixed services
GET `/rateables/services/mixed`

##### Response
```javascript
200 OK

{
  "data": {
    "internal": [
      {
        "id": "3",
        "name": "Woodworking",
        "sub_name": null,
        "scope": "internal",
        "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
        "division_id": "0",
        "type": "services",
        "image_file": "https:\/\/robohash.org\/1562660452.png?set=set1",
        "created_at": "2019-07-09 16:20:50",
        "updated_at": "2019-08-22 11:02:52",
        "division_name": "Unclassified",
        "image_url": "https:\/\/robohash.org\/1562660452.png?set=set1"
      }
    ],
    "external": [
      {
        "id": "2",
        "name": "Tailoring",
        "sub_name": null,
        "scope": "external",
        "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
        "division_id": "0",
        "type": "services",
        "image_file": "1563436171_Screenshot_34.png",
        "created_at": "2019-07-09 16:20:50",
        "updated_at": "2019-08-22 11:02:55",
        "division_name": "Unclassified",
        "image_url": "http:\/\/localhost\/project-speak\/uploads\/rateables\/1563436171_Screenshot_34.png"
      }
    ],
    "unclassified": [
      {
        "id": "26",
        "name": "Serbisyong totoo",
        "sub_name": "Hey!!!",
        "scope": null,
        "description": "",
        "division_id": "2",
        "type": "services",
        "image_file": "1565935022_octocat.png",
        "created_at": "2019-08-16 13:42:43",
        "updated_at": "2019-08-16 13:57:02",
        "division_name": "KPD",
        "image_url": "http:\/\/localhost\/project-speak\/uploads\/rateables\/1565935022_octocat.png"
      }
    ]
  },
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

### Get all people
GET `/rateables/people`

##### Response
```javascript
200 OK

{
  "data": [
    {
      "id": "9",
      "name": "Magen Attraglaitz",
      "sub_name": "A",
      "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
      "division_id": "0",
      "type": "people",
      "image_file": "https:\/\/robohash.org\/1562660456.png?set=set5",
      "created_at": "2019-07-09 16:20:51",
      "updated_at": "2019-08-15 15:18:17",
      "division_name": "Unclassified",
      "image_url": "https:\/\/robohash.org\/1562660456.png?set=set5"
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
|  comment               | no         | string    | comments                         | Lorem ipsum dolor sit amet, consectetur adipisicing elit
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