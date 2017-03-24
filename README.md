Ensurance V2
=========================
Framework PHP : Symfony 3.2


==============
Web services
**

Part User :
-----------

**

 1. **login:**

url : `/api/login`

data to send :

    {
    	"email" : "email@adresse.com",
    	"password" : "password_value"
    	
    }
result : user data or false

 2. **Registration :**

url: `/api/adduser`
type : `post`
data to send :

    {
	"email" : "emailtest@test.fr",
	"password" : "passwordtest"
}
result : user data or form empty

 3. **Profile update:**

url : `/api/profile/{id}`
param : `user id`
data to send :

    {
	"email" : "emailtest@test.fr",
	"nom" : "test 1",
	"prenom" : "prenom 2",
	"date_naissance" : "1999-12-12",
	"date_driver_license" : "2015-11-11",
	"phone" : "21261610101010"
	
}
result : user data + message 

 4. **Password change:**

url: `/api/change_password/{id}`
param : `user_id`
data to send :

    {
	"email" : "emailtest@test.fr",
	"password" : "147258"
	
}
result : message




