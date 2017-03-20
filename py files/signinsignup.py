import pyrebase
import json
from flask import *
import datetime
from time import gmtime, strftime

config = {
    "apiKey": "AIzaSyAHinxQVTwJX4bwBxiSKSfaZ1oa2AC93kg",
    "authDomain": "studentzone-6dce3.firebaseapp.com",
    "databaseURL": "https://studentzone-6dce3.firebaseio.com",
    "storageBucket": "studentzone-6dce3.appspot.com",
    "messagingSenderId": "615898825891",
    "serviceAccount": "studentzone.json"
  }
firebase = pyrebase.initialize_app(config)
# Get a reference to the auth service
auth = firebase.auth()

# Log the user in
user = auth.sign_in_with_email_and_password("new@gmail.com", "123456")

# Get a reference to the database service
db = firebase.database()
app = Flask(__name__)
app.secret_key = 'student zone'

@app.route('/',methods=['POST','GET'])
def index():
	return render_template("registerindex.html")

@app.route('/login',methods=['POST','GET'])
def login():
	if request.method=="POST":
		email=request.form["email"]
		password=request.form["password"]
		users = db.child("users").get()
		users=(users.val())
		logged_in=0
		for i in users:
			if i["id"]==email and i["password"]==password:
				logged_in=1
				return render_template("memberprofile.html",email=email,name=i["name"])
		if logged_in==0:
			flash("Invalid Credentials")
	return render_template("login.html")

@app.route('/register',methods=['POST','GET'])
def signup():
	if request.method=="POST":
		email=request.form["email"]
		password=request.form["password"]
		name=request.form["name"]
		users = db.child("users").get()
		users=(users.val())
		registered=1
		for i in users:
			if i["id"]==email:
				flash("Email Already Exists")
				registered=0
		if registered:
			d={}
			d["id"]=email
			d["password"]=password
			d["name"]=name
			users.append(d)
			n={}
			n["users"]=users
			db.update(n)
			flash("Registered")
	return render_template("register.html")


if __name__ == '__main__':
    app.run( debug=True )