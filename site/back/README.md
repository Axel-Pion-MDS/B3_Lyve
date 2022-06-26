
# MDP Lyve - 2022

Lyve - 2022 - My Digital Project

<!--- If we have only one group/collection, then no need for the "ungrouped" heading -->


## Variables

| Key | Value | Type |
| --- | ------|-------------|
| url | https://lyve.local | string |



## Endpoints

* [User](#user)
    1. [user/list](#1-userlist)
    1. [user/show](#2-usershow)
    1. [user/add](#3-useradd)
    1. [user/edit](#4-useredit)
    1. [user/delete](#5-userdelete)
* [Role](#role)
    1. [role/list](#1-rolelist)
    1. [role/show](#2-roleshow)
    1. [role/add](#3-roleadd)
    1. [role/edit](#4-roleedit)
    1. [role/delete](#5-roledelete)
* [Offer](#offer)
    1. [offer/list](#1-offerlist)
    1. [offer/show](#2-offershow)
    1. [offer/add](#3-offeradd)
    1. [offer/edit](#4-offeredit)
    1. [offer/delete](#5-offerdelete)
* [Module](#module)
    1. [module/list](#1-modulelist)
    1. [module/show](#2-moduleshow)
    1. [module/add](#3-moduleadd)
    1. [module/edit](#4-moduleedit)
    1. [module/delete](#5-moduledelete)
* [Badge](#badge)
    1. [badge/list](#1-badgelist)
    1. [badge/show](#2-badgeshow)
    1. [badge/add](#3-badgeadd)
    1. [badge/edit](#4-badgeedit)
    1. [badge/delete](#5-badgedelete)
* [Chapter](#chapter)
    1. [chapter/list](#1-chapterlist)
    1. [chapter/show](#2-chaptershow)
    1. [chapter/add](#3-chapteradd)
    1. [chapter/edit](#4-chapteredit)
    1. [chapter/delete](#5-chapterdelete)
* [Part](#part)
    1. [part/list](#1-partlist)
    1. [part/show](#2-partshow)
    1. [part/add](#3-partadd)
    1. [part/edit](#4-partedit)
    1. [part/delete](#5-partdelete)
* [Question](#question)
    1. [question/list](#1-questionlist)
    1. [question/show](#2-questionshow)
    1. [question/add](#3-questionadd)
    1. [question/edit](#4-questionedit)
    1. [question/delete](#5-questiondelete)
* [Answer](#answer)
    1. [answer/list](#1-answerlist)
    1. [answer/show](#2-answershow)
    1. [answer/add](#3-answeradd)
    1. [answer/edit](#4-answeredit)
    1. [answer/delete](#5-answerdelete)
* [Security](#security)
    1. [security/login](#1-securitylogin)

--------



## User

Routes for User



### 1. user/list


Get a list of users


***Endpoint:***

```bash
Method: GET
Type: RAW
URL: {{url}}/user/list
```



### 2. user/show


Get an user details from ID


***Endpoint:***

```bash
Method: GET
Type: 
URL: {{url}}/user/show
```



***Query params:***

| Key | Value | Description |
| --- | ------|-------------|
| id | 89 |  |



### 3. user/add


Add an user


***Endpoint:***

```bash
Method: POST
Type: RAW
URL: {{url}}/user/add
```



***Body:***

```js        
{
    "firstname": "Test",
    "lastname": "MDP",
    "email": "test.mdp@gmail.com",
    "birthdate": "2021-03-03",
    "number": "0612345678",
    "role": 1,
    "offer" : "",
    "badges": [1],
    "answers": []
}
```



### 4. user/edit


Edit an user


***Endpoint:***

```bash
Method: PATCH
Type: RAW
URL: {{url}}/user/edit
```



***Body:***

```js        
{
    "id": 89,
    "firstname": "Test",
    "lastname": "Update",
    "email": "test.update@gmail.com",
    "birthdate": "2021-03-03",
    "number": "0612345678",
    "badge": ["1", "2"],
    "answers": []
}
```



### 5. user/delete


Delete an user


***Endpoint:***

```bash
Method: DELETE
Type: 
URL: {{url}}/user/delete
```



***Query params:***

| Key | Value | Description |
| --- | ------|-------------|
| id | 47 |  |



## Role

Routes for Role



### 1. role/list


Get a list of roles


***Endpoint:***

```bash
Method: GET
Type: 
URL: {{url}}/role/list
```



### 2. role/show


Get a role details from ID


***Endpoint:***

```bash
Method: GET
Type: 
URL: {{url}}/role/show
```



***Query params:***

| Key | Value | Description |
| --- | ------|-------------|
| id | 4 |  |



### 3. role/add


Add a role


***Endpoint:***

```bash
Method: POST
Type: RAW
URL: {{url}}/role/add
```



***Body:***

```js        
{
    "title": "testAdd"
}
```



### 4. role/edit


Edit a role


***Endpoint:***

```bash
Method: PATCH
Type: RAW
URL: {{url}}/role/edit
```



***Body:***

```js        
{
    "id": 2,
    "title": "TestUpdate"
}
```



### 5. role/delete


Delete a role from ID


***Endpoint:***

```bash
Method: DELETE
Type: 
URL: {{url}}/role/delete
```



***Query params:***

| Key | Value | Description |
| --- | ------|-------------|
| id | 2 |  |



## Offer

Routes for Offer



### 1. offer/list


Get a list of offers


***Endpoint:***

```bash
Method: GET
Type: 
URL: {{url}}/offer/list
```



### 2. offer/show


Show an offer details from ID


***Endpoint:***

```bash
Method: GET
Type: 
URL: {{url}}/offer/show
```



***Query params:***

| Key | Value | Description |
| --- | ------|-------------|
| id | 12 |  |



### 3. offer/add


Add an offer


***Endpoint:***

```bash
Method: POST
Type: RAW
URL: {{url}}/offer/add
```



***Body:***

```js        
{
    "title": "addOffer",
    "price": "30000",
    "modules": []
}
```



### 4. offer/edit


Edit an offer


***Endpoint:***

```bash
Method: PATCH
Type: RAW
URL: {{url}}/offer/edit
```



***Body:***

```js        
{
    "id": 2,
    "title": "updateOffer",
    "price": 666,
    "modules": []
}
```



### 5. offer/delete


Delete an offer


***Endpoint:***

```bash
Method: DELETE
Type: 
URL: {{url}}/offer/delete
```



***Query params:***

| Key | Value | Description |
| --- | ------|-------------|
| id | 3 |  |



## Module

Routes for Module



### 1. module/list


Get a list of modules


***Endpoint:***

```bash
Method: GET
Type: 
URL: {{url}}/module/list
```



### 2. module/show


Get a module details from ID


***Endpoint:***

```bash
Method: GET
Type: 
URL: {{url}}/module/show
```



***Query params:***

| Key | Value | Description |
| --- | ------|-------------|
| id | 12 |  |



### 3. module/add


Add a module


***Endpoint:***

```bash
Method: POST
Type: RAW
URL: {{url}}/module/add
```



***Body:***

```js        
{
    "title": "addModule",
    "content": "ModuleContent",
    "offers": [],
    "badges": []
}
```



### 4. module/edit


Edit a module


***Endpoint:***

```bash
Method: PATCH
Type: RAW
URL: {{url}}/module/edit
```



***Body:***

```js        
{
    "id": 8,
    "title": "moduleUpdate",
    "content": "moduleUpdate",
    "offers": [],
    "badges": []
}
```



### 5. module/delete


Delete a module from ID


***Endpoint:***

```bash
Method: DELETE
Type: 
URL: {{url}}/module/delete
```



***Query params:***

| Key | Value | Description |
| --- | ------|-------------|
| id | 9 |  |



## Badge

Routes for Badge



### 1. badge/list


Get a list of Badges


***Endpoint:***

```bash
Method: GET
Type: RAW
URL: {{url}}/badge/list
```



### 2. badge/show


Get a Badge details from ID


***Endpoint:***

```bash
Method: GET
Type: 
URL: {{url}}/badge/show
```



***Query params:***

| Key | Value | Description |
| --- | ------|-------------|
| id | 3 |  |



### 3. badge/add


Add a Badge


***Endpoint:***

```bash
Method: POST
Type: RAW
URL: {{url}}/badge/add
```



***Body:***

```js        
{
    "title": "testBadge",
    "picture": "NONE",
    "modules": [],
    "users": []
}
```



### 4. badge/edit


Edit a Badge


***Endpoint:***

```bash
Method: PATCH
Type: RAW
URL: {{url}}/badge/edit
```



***Body:***

```js        
{
    "id": 3,
    "title": "testBadgeUpdate",
    "picture": "NONE",
    "modules": [],
    "users": []
}
```



### 5. badge/delete


Delete a Badge from ID


***Endpoint:***

```bash
Method: DELETE
Type: 
URL: {{url}}/badge/delete
```



***Query params:***

| Key | Value | Description |
| --- | ------|-------------|
| id | 3 |  |



## Chapter

Routes for Chapter



### 1. chapter/list


Get a list of Chapters


***Endpoint:***

```bash
Method: GET
Type: 
URL: {{url}}/chapter/list
```



### 2. chapter/show


Get Chapter from ID


***Endpoint:***

```bash
Method: GET
Type: 
URL: {{url}}/chapter/show
```



***Query params:***

| Key | Value | Description |
| --- | ------|-------------|
| id | 4 |  |



### 3. chapter/add


Add a Chapter


***Endpoint:***

```bash
Method: POST
Type: RAW
URL: {{url}}/chapter/add
```



***Body:***

```js        
{
    "title": "testChapter",
    "content": "testChapterContent",
    "module": 1,
    "parts": [1]
}
```



### 4. chapter/edit


Edit a Chapter


***Endpoint:***

```bash
Method: PATCH
Type: RAW
URL: {{url}}/chapter/edit
```



***Body:***

```js        
{
    "id": 1,
    "title": "ChapterEdit",
    "content": "ChapterEditContent",
    "module": 2,
    "parts": [1]
}
```



### 5. chapter/delete


Delete a Chapter from ID


***Endpoint:***

```bash
Method: DELETE
Type: 
URL: {{url}}/chapter/delete
```



***Query params:***

| Key | Value | Description |
| --- | ------|-------------|
| id | 2 |  |



## Part

Routes for Part



### 1. part/list


Get a list of Parts


***Endpoint:***

```bash
Method: GET
Type: 
URL: {{url}}/part/list
```



### 2. part/show


Get a Part from ID


***Endpoint:***

```bash
Method: GET
Type: 
URL: {{url}}/part/show
```



***Query params:***

| Key | Value | Description |
| --- | ------|-------------|
| id | 3 |  |



### 3. part/add


Add a Part


***Endpoint:***

```bash
Method: POST
Type: RAW
URL: {{url}}/part/add
```



***Body:***

```js        
{
    "title": "PartTitle",
    "content": "PartContent",
    "chapter": 1
}
```



### 4. part/edit


Edit a Part


***Endpoint:***

```bash
Method: PATCH
Type: RAW
URL: {{url}}/part/edit
```



***Body:***

```js        
{
    "id": 2,
    "title": "PartTitleEdit",
    "content": "PartContentEdit",
    "chapter": 1
}
```



### 5. part/delete


Delete a Part from ID


***Endpoint:***

```bash
Method: DELETE
Type: 
URL: {{url}}/part/delete
```



***Query params:***

| Key | Value | Description |
| --- | ------|-------------|
| id | 2 |  |



## Question

Routes for Question



### 1. question/list


Get a list of Questions


***Endpoint:***

```bash
Method: GET
Type: 
URL: {{url}}/question/list
```



### 2. question/show


Get a Question from ID


***Endpoint:***

```bash
Method: GET
Type: 
URL: {{url}}/question/show
```



***Query params:***

| Key | Value | Description |
| --- | ------|-------------|
| id | 1 |  |



### 3. question/add


Add a Question


***Endpoint:***

```bash
Method: POST
Type: RAW
URL: {{url}}/question/add
```



***Body:***

```js        
{
    "question": "Question ?",
    "part": 1
}
```



### 4. question/edit


Edit a Question


***Endpoint:***

```bash
Method: PATCH
Type: RAW
URL: {{url}}/question/edit
```



***Body:***

```js        
{
    "id": 1,
    "question": "QuestionEdit ?",
    "part": 1
}
```



### 5. question/delete


Delete a question from ID


***Endpoint:***

```bash
Method: DELETE
Type: 
URL: {{url}}/question/delete
```



***Query params:***

| Key | Value | Description |
| --- | ------|-------------|
| id | 1 |  |



## Answer

Routes for Answer



### 1. answer/list


Get a list of Answers


***Endpoint:***

```bash
Method: GET
Type: 
URL: {{url}}/answer/list
```



### 2. answer/show


Get an Answer details from ID


***Endpoint:***

```bash
Method: GET
Type: 
URL: {{url}}/answer/show
```



***Query params:***

| Key | Value | Description |
| --- | ------|-------------|
| id | 1 |  |



### 3. answer/add


Add an Answer


***Endpoint:***

```bash
Method: POST
Type: RAW
URL: {{url}}/answer/add
```



***Body:***

```js        
{
    "answer": "Answer 2",
    "isCorrect": 1,
    "question": 2,
    "users": []
}
```



### 4. answer/edit


Edit an Answer


***Endpoint:***

```bash
Method: PATCH
Type: RAW
URL: {{url}}/answer/edit
```



***Body:***

```js        
{
    "id": 2,
    "answer": "Answer 1 Edit",
    "isCorrect": 0,
    "question": 2,
    "users": []
}
```



### 5. answer/delete


Delete an Answer from ID


***Endpoint:***

```bash
Method: DELETE
Type: 
URL: {{url}}/answer/delete
```



***Query params:***

| Key | Value | Description |
| --- | ------|-------------|
| id | 2 |  |



## Security



### 1. security/login



***Endpoint:***

```bash
Method: GET
Type: RAW
URL: {{url}}/security/login
```



***Body:***

```js        
{
    "username": "test.mdp@gmail.com",
    "password": "abc"
}
```



---
[Back to top](#mdp-lyve---2022)

>Generated at 2022-06-26 14:20:52 by [docgen](https://github.com/thedevsaddam/docgen)
