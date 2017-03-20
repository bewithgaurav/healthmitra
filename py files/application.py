import pyrebase
import json
from flask import *
import datetime
from time import gmtime, strftime


config = {
  	
  	"apiKey" : "AIzaSyCLlwtDViQPRFWCYrm4OXVUoXx5oC12e2U",
	"authDomain" : "test-38881.firebaseapp.com",
	"databaseURL" : "https://test-38881.firebaseio.com",
	"storageBucket" : "test-38881.appspot.com",
	"messagingSenderId" : "136023743018"

}

firebase = pyrebase.initialize_app(config)
# Get a reference to the auth service
auth = firebase.auth()

# Log the user in
user = auth.sign_in_with_email_and_password("rajasthantest@gmail.com", "8435502007")

# Get a reference to the database service
db = firebase.database()
app = Flask(__name__)

@app.route('/',methods=['POST','GET'])
def login():
	return render_template("login.html")

@app.route('/dashboard',methods=['POST','GET'])
def dashboard():
	return render_template("index.html")

@app.route('/users',methods=['POST','GET'])
def users():
	return render_template("users.html")

@app.route('/calendar',methods=['POST','GET'])
def calendar():
	return render_template("calendar.html")

@app.route('/posts',methods=['POST','GET'])
def posts():
	return render_template("posts.html")

@app.route('/addpost',methods=['POST','GET'])
def index():
	if request.method=="POST":
		content=request.form["content"]
		heading=request.form["heading"]
		file=request.form["file"]
		t=strftime("%Y-%m-%d %H:%M:%S", gmtime())
		print(t)
		# content=content.encode('utf8')
		# heading=heading.encode('utf8')
		d={}
		d["content"]=content
		d["heading"]=heading
		d["file"]=file
		print(file)
		# d=json.dumps(d)
		# print(content,heading)
		storage = firebase.storage()
		# storage.child(file).put("static/img/"+file)
		# d["picture"]=storage.child(file).get_url(user['idToken'])
		# print("localhost:5000/static/img/"+file)
		db.child("users").update(d)
		# db.child("users").child("heading").update(heading)
		return render_template("login.html")
		
	users = db.child("users").get()
	a=(users.val())

	print(a)
	return render_template("form-common.html")


if __name__ == '__main__':
    app.run( debug=True )