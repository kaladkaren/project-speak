# Project Speak API
[![Bless](https://cdn.rawgit.com/LunaGao/BlessYourCodeTag/master/tags/sakyamuni.svg)](http://lunagao.github.io/BlessYourCodeTag/)
[![Bless](https://cdn.rawgit.com/LunaGao/BlessYourCodeTag/master/tags/fsm.svg)](http://lunagao.github.io/BlessYourCodeTag/)

## Table of contents

|     Resource      |                         Route                         |    Needs `DEVICE-ID` header     | Status | Recently modified  
|-------------------|-------------------------------------------------------|------------------------------------|--------|--------------------
| Devices           | [Register device ID](#register-device-id)             |                  no                | 🆗    | 
| Members           | [Get all internal members](#get-all-internal-members) |                  no                | 🆗    | 
| Divisions         | [Get all divisions](#get-all-divisions)               |                  no                | 🆗    | 
| Departments       | [Get all departments](#get-all-departments)           |                  no                | 🆗    | 
| Sub agencies      | [Get all sub agencies](#get-all-sub-agencies)         |                  no                |  🆗   | 
| Sub agencies      | [Get all sub agencies by department id](#get-all-sub-agencies-by-department-id) |          no            |  🆗   | 
| Options **(NEW)** | [Check rateables status](#check-rateables-status)     |                  no                |  🆗    | 
| Rateables         | [Get all services](#get-all-services)                 |                  **yes**           |  🆗    | 
| Rateables         | [Get all experience](#get-all-experience)             |                  **yes**           |  🆗    | 
| Rateables         | [Get all people](#get-all-people)                     |                  **yes**           |  🆗    | 
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
### Check rateables status  
Checks if there is an updated rateable  
POST `/options/rateables`  

|      Name      | Required |   Type    |    Description    |    Sample Data 
|----------------|----------|-----------|-------------------|-----------------------
|    device_id   |  yes     |  string   |        -          |    1234asdzxcvbn 
| last_updated   |  yes     |  string   | local datetime last updated on the device | 2019-08-11 00:00:00

##### Response
```javascript
200 OK

{
  "data": {
    "rateables" : [ 
        {
          "type":"services",
          "is_updated": false
        },
        {
          "type":"experience",
          "is_updated": true
        },
        {
          "type":"people",
          "is_updated": false
        }
      ],
      "is_reassigned": true  // if the rateables have changed order/or have been reassigned.
       //if this is true, then it is necessary to call all rateable endpoints regardless if they are updated or not
    }
  },
  "meta": {
    "message": "Got all data",
    "status": 200,
    "code": "ok",
    "datetime": "2019-07-30 17:19:03"
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
  "data": [
    {
      "id": "6",
      "name": "Gold Experience",
      "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
      "type": "experience",
      "image_file": "https:\/\/robohash.org\/1562320426.png?set=set2",
      "created_at": "2019-07-05 17:53:46",
      "updated_at": "0000-00-00 00:00:00",
      "image_url": "https:\/\/robohash.org\/1562660456.png?set=set5"
    },
    {
      "id": "7",
      "name": "Test Experience",
      "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
      "type": "experience",
      "image_file": "https:\/\/robohash.org\/1562320426.png?set=set2",
      "created_at": "2019-07-05 17:53:46",
      "updated_at": "0000-00-00 00:00:00",
      "image_url": "https:\/\/robohash.org\/1562660456.png?set=set5"
    } 
  ],
  "meta": {
    "message": "Got all data",
    "status": 200,
    "code": "ok",
    "station": {
      "station_id": "2",
      "station_name": "Rotun Dale Magical Library"
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
      "id": "2",
      "name": "Smithing",
      "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
      "type": "services",
      "image_file": "https:\/\/robohash.org\/1562320426.png?set=set1",
      "created_at": "2019-07-05 17:53:46",
      "updated_at": "0000-00-00 00:00:00",
      "image_url": "https:\/\/robohash.org\/1562660456.png?set=set5"
    },
    {
      "id": "3",
      "name": "Woodworking",
      "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
      "type": "services",
      "image_file": "https:\/\/robohash.org\/1562320426.png?set=set1",
      "created_at": "2019-07-05 17:53:46",
      "updated_at": "0000-00-00 00:00:00",
      "image_url": "https:\/\/robohash.org\/1562660456.png?set=set5"
    } 
  ],
  "meta": {
    "message": "Got all data",
    "status": 200,
    "code": "ok",
    "station": {
      "station_id": "2",
      "station_name": "Rotun Dale Magical Library"
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
      "id": "10",
      "name": "Sin Grey Audragonel",
      "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
      "type": "people",
      "image_file": "https:\/\/robohash.org\/1562320426.png?set=set5",
      "created_at": "2019-07-05 17:53:46",
      "updated_at": "0000-00-00 00:00:00",
      "image_url": "https:\/\/robohash.org\/1562660456.png?set=set5"
    },
    {
      "id": "11",
      "name": "Godfrey Fvjyana",
      "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
      "type": "people",
      "image_file": "https:\/\/robohash.org\/1562320426.png?set=set5",
      "created_at": "2019-07-05 17:53:46",
      "updated_at": "0000-00-00 00:00:00",
      "image_url": "https:\/\/robohash.org\/1562660456.png?set=set5"
    } 
  ],
  "meta": {
    "message": "Got all data",
    "status": 200,
    "code": "ok",
    "station": {
      "station_id": "2",
      "station_name": "Rotun Dale Magical Library"
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