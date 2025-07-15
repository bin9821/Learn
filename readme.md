#Listings Tasks web (Laravel 12)

##學習目標：
  - 路由與 Controller
  - Blade 模板
  - Model & Migration
  - CRUD 操作
  - 表單驗證和CSRF保護
  - Flash 訊息
  - 資料過濾（Filtering）
  - Tailwind CSS 整合

---
#REST API & Sanctum(Laravel 10)

##API用途與參數

###POST /api/login
**用途：使用者登入，成功後回傳一組 Token 供後續 API 認證使用。**
請求格式（JSON）：
```
{
  "email": "user@example.com",
  "password": "password"
}
```
成功回應：
```
{
  "token": "7|56fmyQ3QmaQT6tDm4WEEjtjs3knTIILciKMIuvSL92fbc6c0"
}
```

###POST /api/logout
**用途：使用者登出，Bearer Token輸入登入獲得的Token後刪除Token**
```
成功回應：
{
    "message": "logged out"
}
```

---
###GET /api/events
**支援 include 參數（可選）：user, attendees, attendees.user**
**用途：查看所有event的資料**
成功回應（有帶入user參數）：
```
{
    "data": [
        {
            "id": 136,
            "name": "Voluptatem tenetur autem.",
            "description": "Qui velit et veritatis illum eum ipsa libero. Velit exercitationem exercitationem accusantium atque. Deserunt facere molestiae aut autem.",
            "start_time": "2025-07-17 11:40:11",
            "end_time": "2025-08-20 12:17:17",
            "user": {
                "id": 603,
                "name": "Dane Labadie",
                "email": "eino16@example.net",
                "email_verified_at": "2025-06-24T17:16:17.000000Z",
                "created_at": "2025-06-24T17:16:24.000000Z",
                "updated_at": "2025-06-24T17:16:24.000000Z"
            }
        },
        {
            "id": 135,
            "name": "Ipsa velit explicabo et.",
            "description": "At a quisquam quo repellendus rem voluptatem saepe quod. Qui officia ipsa recusandae modi. Assumenda unde expedita nihil voluptate sapiente quis ipsa.",
            "start_time": "2025-07-12 14:56:47",
            "end_time": "2025-08-14 14:01:39",
            "user": {
                "id": 419,
                "name": "Prof. Travis Nienow",
                "email": "zoila.waters@example.com",
                "email_verified_at": "2025-06-24T17:16:16.000000Z",
                "created_at": "2025-06-24T17:16:22.000000Z",
                "updated_at": "2025-06-24T17:16:22.000000Z"
            }
        }
    ]
}
```

###POST /api/events
**用途：新增指定User的一筆Event的資料(需要Bearer Token驗證)**
請求格式（JSON）：
```
{
    "name": "Tom", //required|string|max:255
    "description":  "description",  //nullable|string
    "start_time": "2005-03-01 17:00:00",  //required|date
    "end_time": "2005-03-02 18:00:00"  //required|date|after:start_time
}
```
成功回應：
```
{
    "data": {
        "id": 208,
        "name": "Tom",
        "description": "description",
        "start_time": "2005-03-01 17:00:00",
        "end_time": "2005-03-02 18:00:00"
    }
}
```

###GET /api/events/{event}
**支援 include 參數（可選）：'user', 'attendees', 'attendees.user'**
**用途：查看特定Event的資料**
成功回應：
```
{
    "data": {
        "id": 20,
        "name": "Assumenda temporibus odit.",
        "description": "Vero rerum sed nobis rerum. Animi quos expedita expedita ipsam aliquid. Eum omnis consequatur autem sint. Expedita et enim qui enim voluptates vel error.",
        "start_time": "2025-07-09 04:17:12",
        "end_time": "2025-08-16 03:35:38"
    }
}
```

###PUT /api/events/{event}
**用途：更改指定User的一筆Event的資料(需要Bearer Token驗證)**
請求格式（JSON）：
```
{
    "name": "Tom", //sometimes|string|max:255
    "description":  "description",  //nullable|string
    "start_time": "2005-03-01 17:00:00",  //sometimes|date
    "end_time": "2005-03-02 18:00:00"  //sometimes|date|after:start_time
}
```
成功回應：
```
{
    "data": {
        "id": 20,
        "name": "Tom",
        "description": "description",
        "start_time": "2005-03-01 17:00:00",
        "end_time": "2005-03-02 18:00:00"
    }
}
```

###DELETE /api/events/{event}
**用途：刪除指定User的一筆Event的資料(需要Bearer Token驗證)**
成功回應 HTTP 204（No Content）：

---
###GET /api/events/{event}/attendees
**支援 include 參數（可選）：'user'**
**用途：查看指定event的下所有attendee的資料**
成功回應：
```
{
    "data": [
        {
            "id": 1982,
            "user_id": 1,
            "event_id": 10,
            "created_at": "2025-07-03T08:51:05.000000Z",
            "updated_at": "2025-07-03T08:51:05.000000Z"
        },
        {
            "id": 1701,
            "user_id": 855,
            "event_id": 10,
            "created_at": "2025-06-24T17:16:44.000000Z",
            "updated_at": "2025-06-24T17:16:44.000000Z"
        }
    ]
}
```

###POST /api/events/{event}/attendees
**用途：新增User的attendees進入該event(需要Bearer Token驗證)**
請求格式（JSON）：
```
{
    "name": "Tom", //required|string|max:255
    "description":  "description",  //nullable|string
    "start_time": "2005-03-01 17:00:00",  //required|date
    "end_time": "2005-03-02 18:00:00"  //required|date|after:start_time
}
```
成功回應：
```
{
    "user_id": 370,
    "event_id": 10,
    "updated_at": "2025-07-15T04:01:47.000000Z",
    "created_at": "2025-07-15T04:01:47.000000Z",
    "id": 1984
}
```

###GET /api/events/{event}/attendees/{attendee}
**支援 include 參數（可選）：'user'**
**用途：查看特定Event下的指定attendee資料**
成功回應：
```
{
    "data": {
        "id": 1701,
        "user_id": 855,
        "event_id": 10,
        "created_at": "2025-06-24T17:16:44.000000Z",
        "updated_at": "2025-06-24T17:16:44.000000Z"
    }
}
```

###DELETE /api/events/{event}/attendees/{attendee}
**用途：刪除指定User的一筆attendee的資料(需要Bearer Token驗證)**
成功回應 HTTP 204（No Content）：