# Post Task Questionaire
Post Task questionaire created for Energenious (https://www.energenious.eu/) in the I&E (Innovation & Entrepreneurship) Course at TU Berlin

# index.php
Main page with the box for the website loading and the bottom part for the questions

# style.css
General cascading stylesheet of the main page

# utils.php
Library of php functions to read from the task.csv file and write to the db

# script.py 
Python script to create a brand new database file: answers.db.

# task.csv 
Contains the post task questionaires in the following format:
id, task_description

It is thought to be easily editable without specific knowledge.

The reordering based on their difficulty is the following:
- 1,Find energenious contact information
- 2,Find the survey page
- 3,Find the login page for registered users
- 4,Find energenious partners 
- 5,Find energenious features
- 6,Find energenious team structure
- 7,Find the services offered by energenious and then find contact information for a first contact
- 8,Find information about the scope of energenious 
- 9,Find out why can you benefit from energenious
- 10,Find some results about how effective was the energy optimisation provided by energenious. 
- 11,Find the latest information about energenious

# answers.db
sqlite3 database that contains all the info with the following schema
for table ANSWERS
[generated_id] INTEGER PRIMARY KEY,
[Username] text, 
[Task_Code] integer, 
[Question_Code] integer, 
[Answer_Score] integer, 
[Date] date
It can be easily queried with any python program using pandas library (traditional datascience).

