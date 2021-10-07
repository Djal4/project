API Endpoints:
/project/src/public{/Intern,/Mentor,/Group,/Comment}
When doing get request if Id is not provided it will list all:
-users(mentors/interns)
-groups
-comments.
POST:
When sending post request you must provide:
-title for group
-mentor_id,intern_id,comment for Comment
-name,lastname,group_id for Users(/Intern ,/Mentor)
PUT:
When sending put request you must provide ID for all Endpoints, title for group(only param), for other endpoints you can provide any of of params.
