<?php
//this is the registration page for the user
//this will contain a form with email address, DOB, gender, username, password
//when submitting, we must check that username and email should not be present already in the database
//if existing, then ask the user in a flash message to change the username, or tell them that they are already existing
//we will also use the regex to check the format of the username and email gender age and password
//you should have a calendar dropdown for the DOB option, once selected the age should automatically populate as the current age
//format checking
//username -> should contain only alphanumerics, no special chars, can not start with a number
//userfirstname
//userlastname
//userimage
//userdob
//userregistereddate
//email -> must contain @ and .com at the end
//gender -> this will be a radio button with options of M(male), F(female), Q(queer), O(other)
//password -> has to be atleast 8 chars and atmost 12 chars -> must contain a smallcase letter, an uppercase letter and a number and a special char
//generate a php alert confirming the age of the user
//once registration is successful, send an OTP that is randomly generated on the backend to the user's email and take them to the 
//OTP confirmation page
//if correctly confirmed then take the user  to the login page, if not then wait for three turns(do this by incrementing session var) and then land back to the registration page (destroy the session in case the otp session var is still goiong on)
//if there is any issue with the registration, provide with the correct flash message and ask the user to correct those details
//

?>
