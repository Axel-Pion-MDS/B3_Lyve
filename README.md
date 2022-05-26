# Lyve

My Digital School - 2022 My Digital Project : Lyve

## Endpoints

* [User](#user)
    1. [user/list](#1-userlist)
    2. [user/show](#2-usershow)
    3. [user/add](#3-useradd)
    4. [user/edit](#4-useredit)
    5. [user/delete](#5-userdelete)
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

--------

## User

Routes for User

### 1. user/list

Get a list of users

***Endpoint:***

```bash
Method: GET
Type: RAW
URL: https://lyve.local/user/list
```

### 2. user/show

Get a user details from ID

***Endpoint:***

```bash
Method: GET
Type: 
URL: https://lyve.local/user/show
```

***Query params:***

| Key | Value |
| --- | ------|
| id | 89 |

### 3. user/add

Add a user

***Endpoint:***

```bash
Method: POST
Type: RAW
URL: https://lyve.local/user/add
```

***Body:***

```json        
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

Edit a user

***Endpoint:***

```bash
Method: PATCH
Type: RAW
URL: https://lyve.local/user/edit
```

***Body:***

```json        
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

Delete a user

***Endpoint:***

```bash
Method: DELETE
Type: 
URL: https://lyve.local/user/delete
```

***Query params:***

| Key | Value |
| --- | ------|
| id | 47 |

## Role

Routes for Role

### 1. role/list

Get a list of roles

***Endpoint:***

```bash
Method: GET
Type: 
URL: https://lyve.local/role/list
```

### 2. role/show

Get a role details from ID

***Endpoint:***

```bash
Method: GET
Type: 
URL: https://lyve.local/role/show
```

***Query params:***

| Key | Value |
| --- | ------|
| id | 4 |

### 3. role/add

Add a role

***Endpoint:***

```bash
Method: POST
Type: RAW
URL: https://lyve.local/role/add
```

***Body:***

```json        
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
URL: https://lyve.local/role/edit
```

***Body:***

```json        
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
URL: https://lyve.local/role/delete
```

***Query params:***

| Key | Value |
| --- | ------|
| id | 2 |

## Offer

Routes for Offer

### 1. offer/list

Get a list of offers

***Endpoint:***

```bash
Method: GET
Type: 
URL: https://lyve.local/offer/list
```

### 2. offer/show

Show an offer details from ID

***Endpoint:***

```bash
Method: GET
Type: 
URL: https://lyve.local/offer/show
```

***Query params:***

| Key | Value |
| --- | ------|
| id | 12 |

### 3. offer/add

Add an offer

***Endpoint:***

```bash
Method: POST
Type: RAW
URL: https://lyve.local/offer/add
```

***Body:***

```json        
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
URL: https://lyve.local/offer/edit
```

***Body:***

```json        
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
URL: https://lyve.local/offer/delete
```

***Query params:***

| Key | Value |
| --- | ------|
| id | 3 |

## Module

Routes for Module

### 1. module/list

Get a list of modules

***Endpoint:***

```bash
Method: GET
Type: 
URL: https://lyve.local/module/list
```

### 2. module/show

Get a module details from ID

***Endpoint:***

```bash
Method: GET
Type: 
URL: https://lyve.local/module/show
```

***Query params:***

| Key | Value |
| --- | ------|
| id | 12 |

### 3. module/add

Add a module

***Endpoint:***

```bash
Method: POST
Type: RAW
URL: https://lyve.local/module/add
```

***Body:***

```json        
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
URL: https://lyve.local/module/edit
```

***Body:***

```json        
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
URL: https://lyve.local/module/delete
```

***Query params:***

| Key | Value |
| --- | ------|
| id | 9 |

## Badge

Routes for Badge

### 1. badge/list

Get a list of Badges

***Endpoint:***

```bash
Method: GET
Type: RAW
URL: https://lyve.local/badge/list
```

### 2. badge/show

Get a Badge details from ID

***Endpoint:***

```bash
Method: GET
Type: 
URL: https://lyve.local/badge/show
```

***Query params:***

| Key | Value |
| --- | ------|
| id | 3 |

### 3. badge/add

Add a Badge

***Endpoint:***

```bash
Method: POST
Type: RAW
URL: https://lyve.local/badge/add
```

***Body:***

```json        
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
URL: https://lyve.local/badge/edit
```

***Body:***

```json        
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
URL: https://lyve.local/badge/delete
```

***Query params:***

| Key | Value |
| --- | ------|
| id | 3 |

## Chapter

Routes for Chapter

### 1. chapter/list

Get a list of Chapters

***Endpoint:***

```bash
Method: GET
Type: 
URL: https://lyve.local/chapter/list
```

### 2. chapter/show

Get Chapter from ID

***Endpoint:***

```bash
Method: GET
Type: 
URL: https://lyve.local/chapter/show
```

***Query params:***

| Key | Value |
| --- | ------|
| id | 4 |

### 3. chapter/add

Add a Chapter

***Endpoint:***

```bash
Method: POST
Type: RAW
URL: https://lyve.local/chapter/add
```

***Body:***

```json        
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
URL: https://lyve.local/chapter/edit
```

***Body:***

```json        
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
URL: https://lyve.local/chapter/delete
```

***Query params:***

| Key | Value |
| --- | ------|
| id | 2 |

## Part

Routes for Part

### 1. part/list

Get a list of Parts

***Endpoint:***

```bash
Method: GET
Type: 
URL: https://lyve.local/part/list
```

### 2. part/show

Get a Part from ID

***Endpoint:***

```bash
Method: GET
Type: 
URL: https://lyve.local/part/show
```

***Query params:***

| Key | Value |
| --- | ------|
| id | 1 |

### 3. part/add

Add a Part

***Endpoint:***

```bash
Method: POST
Type: RAW
URL: https://lyve.local/part/add
```

***Body:***

```json        
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
URL: https://lyve.local/part/edit
```

***Body:***

```json        
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
URL: https://lyve.local/part/delete
```

***Query params:***

| Key | Value |
| --- | ------|
| id | 2 |

## Question

Routes for Question

### 1. question/list

Get a list of Questions

***Endpoint:***

```bash
Method: GET
Type: 
URL: https://lyve.local/question/list
```

### 2. question/show

Get a Question from ID

***Endpoint:***

```bash
Method: GET
Type: 
URL: https://lyve.local/question/show
```

***Query params:***

| Key | Value |
| --- | ------|
| id | 1 |

### 3. question/add

Add a Question

***Endpoint:***

```bash
Method: POST
Type: RAW
URL: https://lyve.local/question/add
```

***Body:***

```json        
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
URL: https://lyve.local/question/edit
```

***Body:***

```json        
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
URL: https://lyve.local/question/delete
```

***Query params:***

| Key | Value |
| --- | ------|
| id | 1 |

## Answer

Routes for Answer

### 1. answer/list

Get a list of Answers

***Endpoint:***

```bash
Method: GET
Type: 
URL: https://lyve.local/answer/list
```

### 2. answer/show

Get an Answer details from ID

***Endpoint:***

```bash
Method: GET
Type: 
URL: https://lyve.local/answer/show
```

***Query params:***

| Key | Value |
| --- | ------|
| id | 1 |

### 3. answer/add

Add an Answer

***Endpoint:***

```bash
Method: POST
Type: RAW
URL: https://lyve.local/answer/add
```

***Body:***

```json       
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
URL: https://lyve.local/answer/edit
```

***Body:***

```json        
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
URL: https://lyve.local/answer/delete
```

***Query params:***

| Key | Value |
| --- | ------|
| id | 2 |

---
[Back to top](#mdp-lyve---2022)

## Integrate with your tools

- [ ] [Set up project integrations](https://gitlab.com/Maengdok/lyve/-/settings/integrations)

## Collaborate with your team

- [ ] [Invite team members and collaborators](https://docs.gitlab.com/ee/user/project/members/)
- [ ] [Create a new merge request](https://docs.gitlab.com/ee/user/project/merge_requests/creating_merge_requests.html)
- [ ] [Automatically close issues from merge requests](https://docs.gitlab.com/ee/user/project/issues/managing_issues.html#closing-issues-automatically)
- [ ] [Enable merge request approvals](https://docs.gitlab.com/ee/user/project/merge_requests/approvals/)
- [ ] [Automatically merge when pipeline succeeds](https://docs.gitlab.com/ee/user/project/merge_requests/merge_when_pipeline_succeeds.html)

## Test and Deploy

Use the built-in continuous integration in GitLab.

- [ ] [Get started with GitLab CI/CD](https://docs.gitlab.com/ee/ci/quick_start/index.html)
- [ ] [Analyze your code for known vulnerabilities with Static Application Security Testing(SAST)](https://docs.gitlab.com/ee/user/application_security/sast/)
- [ ] [Deploy to Kubernetes, Amazon EC2, or Amazon ECS using Auto Deploy](https://docs.gitlab.com/ee/topics/autodevops/requirements.html)
- [ ] [Use pull-based deployments for improved Kubernetes management](https://docs.gitlab.com/ee/user/clusters/agent/)
- [ ] [Set up protected environments](https://docs.gitlab.com/ee/ci/environments/protected_environments.html)

***

# Editing this README

When you're ready to make this README your own, just edit this file and use the handy template below (or feel free to structure it however you want - this is just a starting point!).  Thank you to [makeareadme.com](https://www.makeareadme.com/) for this template.

## Suggestions for a good README
Every project is different, so consider which of these sections apply to yours. The sections used in the template are suggestions for most open source projects. Also keep in mind that while a README can be too long and detailed, too long is better than too short. If you think your README is too long, consider utilizing another form of documentation rather than cutting out information.

## Name
Choose a self-explaining name for your project.

## Description
Let people know what your project can do specifically. Provide context and add a link to any reference visitors might be unfamiliar with. A list of Features or a Background subsection can also be added here. If there are alternatives to your project, this is a good place to list differentiating factors.

## Badges
On some READMEs, you may see small images that convey metadata, such as whether or not all the tests are passing for the project. You can use Shields to add some to your README. Many services also have instructions for adding a badge.

## Visuals
Depending on what you are making, it can be a good idea to include screenshots or even a video (you'll frequently see GIFs rather than actual videos). Tools like ttygif can help, but check out Asciinema for a more sophisticated method.

## Installation
Within a particular ecosystem, there may be a common way of installing things, such as using Yarn, NuGet, or Homebrew. However, consider the possibility that whoever is reading your README is a novice and would like more guidance. Listing specific steps helps remove ambiguity and gets people to using your project as quickly as possible. If it only runs in a specific context like a particular programming language version or operating system or has dependencies that have to be installed manually, also add a Requirements subsection.

## Usage
Use examples liberally, and show the expected output if you can. It's helpful to have inline the smallest example of usage that you can demonstrate, while providing links to more sophisticated examples if they are too long to reasonably include in the README.

## Support
Tell people where they can go to for help. It can be any combination of an issue tracker, a chat room, an email address, etc.

## Roadmap
If you have ideas for releases in the future, it is a good idea to list them in the README.

## Contributing
State if you are open to contributions and what your requirements are for accepting them.

For people who want to make changes to your project, it's helpful to have some documentation on how to get started. Perhaps there is a script that they should run or some environment variables that they need to set. Make these steps explicit. These instructions could also be useful to your future self.

You can also document commands to lint the code or run tests. These steps help to ensure high code quality and reduce the likelihood that the changes inadvertently break something. Having instructions for running tests is especially helpful if it requires external setup, such as starting a Selenium server for testing in a browser.

## Authors and acknowledgment
Show your appreciation to those who have contributed to the project.

## License
For open source projects, say how it is licensed.

## Project status
If you have run out of energy or time for your project, put a note at the top of the README saying that development has slowed down or stopped completely. Someone may choose to fork your project or volunteer to step in as a maintainer or owner, allowing your project to keep going. You can also make an explicit request for maintainers.
