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
	"messagingSenderId" : "136023743018",
	"serviceAccount": "auth.json"
}

firebase = pyrebase.initialize_app(config)
auth = firebase.auth()
user = auth.sign_in_with_email_and_password("rajasthantest@gmail.com", "8602229193")
db = firebase.database()

app = Flask(__name__)
app.config['UPLOAD_FOLDER']='/uploaded'
app.secret_key = 'moriarty'

@app.route('/notify',methods=['POST','GET'])
def notify():
	a={}
	a["bloodgroup"]=request.args['bloodgroup']
	a["uid"]=request.args['id']
    a["city"]=request.args['city']
    a["mobile"]=request.args['mobile']
    a["address"]=request.args['address']
    mobile=
	users = db.child("users").get()
	users=(users.val())
	response={}
	c=0
	for user in users:
		if user["bloodgroup"]==a["bloodgroup"] and a["district"]==user["district"]:
			c+=1
			a.append(
				{
					"name":user["name"],
					"mobile":user["mobile"]
				}
			)
	
	if c:
		registration_ids = ["ewEDOBTYu-w:APA91bG-Gc9SZPT7YY82jubMJ-WYWfpfSe3JXc1T9oSuWQpwoIe1DZjrveXnOcagCdM3Px0iWVqSBqSvM1qWvBQy3bw9U3Ad8897qu3ZHSRVkwX_29oBxbhjTlmqoyrlIcRpHC8t9JgE"]
		message_title = "Sanskar"
		message_body = "Chutiya hai"
		result = push_service.notify_multiple_devices(registration_ids=registration_ids, message_title=message_title, message_body=message_body, message_icon="facebook.png")

	return jsonify(response)

if __name__ == '__main__':
    app.run( debug=True )