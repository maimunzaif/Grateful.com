# CSCI 2170: Intro to Server-Side Scripting

__*Assignment 4 - Dalhousie University Forum*__

## Student Information

- __Name__: Zaif Tanay  
- __Student ID__: B00915793
- __Date Created__: 2024-11-25

## Overview & Testing & Use Cases

Describe your forum application here - in about 250 words, i.e., how does it work? How do the TAs/markers test your application?

How do we test your application? What are the use cases? Write your applications' use cases, if there are any specific considerations for us to make (like if you've implemented the bonus feature(s), etc.).

Write the response to this section in bullet points.

I merged the overview and test cases together as its easier to decribe it for my application.

## Task 1 Implementation

anyone who visits the site should be able to see the posts in reverse chronological order. However they can only see the post and not access any other feature. The post are fetched asyncronously.

## Task 2 Implementation 

Non-logged in users and logged in users have a sperate user menu as shown in the header.php. If they are not logged in their context menu will have links to the login page and dashboard only. if the user is logged in, then they can message, add posts and logout. In the login page, the nav has link to dashboard only.

if a non-logged in user tries to access message and posts features, then they will redirected to login page. And the login funcionality is asynchronous.

## Task 3 Implementation
for this section you would need 2 valid accounts to test it. there is no register user form as it was not a requirement for this assignment. So you would need to manualy insert the users into the table. 

for ease of testing, use these sql statements with usernames user1 & user2 they both have a password of '12345'. or feel free to use your own account.

INSERT INTO `users` (`username`, `password`) VALUES ('user1', '$2y$10$LPgr.8efiIvzJn1ooe9YBOor4fCvh7JMUcSTfQsOYaKcA6E4Kehqi');

INSERT INTO `users` (`username`, `password`) VALUES ('user2', '$2y$10$LPgr.8efiIvzJn1ooe9YBOor4fCvh7JMUcSTfQsOYaKcA6E4Kehqi');


In the messages page, the user can see 2 tables, one with messages sent and one with messages recieved, similar to an emails inbox and sent messages. there is also an add message button, similar to a 'compose' button in an email which will take you to a form to send message. in the form the user has to write the recepients username (accurately) and the contents of the message. This message will show up on the 'sent messages table'. 

If another user sends a message it should load up on the recieved messages table, without needing to refresh the page, as it iis being polled every 5 seconds. All messages are being feetched asynchonously.

## Task 4 Implementation 

In the user context Menu, there is an add post option which will take you to a form to add posts. this post will show up on the dashboard. and only the author of a post will have the option to edit or delete the post. 

IF the author wants to edit the post, he can click on the edit post button and a form will show up with the contents of the post and they can edit it and submit it. all these changes will happen asynchronously without refreshing the page.

# Bonus implementation

all the posts will have an upvotes button, if any user clicks the button, the upvotes count increases by 1 and if they click it again, it decreases by 1. The upvotes count for a post depends on how many users have upvoted that post. the counter is visible in the upvotes button.If a user not logged it, they cannot upvote. 

and lastly pls be generous with the grading. thank youuuu.🙏

## Citations

1. Login form taaken from Assignment 3. Date accessed: 2024-11-25
