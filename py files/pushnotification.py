from pyfcm import FCMNotification

push_service = FCMNotification(api_key="AAAAH6ulmio:APA91bHmJnSaRswJukPEUnVe4OPl00qqqfoypMAjdVFWPAI2n-6C-ymn9tGQ31WkNonM16X-82TAd2GHJZgJcXjzG4AaqphrgBtlGwjyAzzkvDnue3p10AwTaNEUonAKESIFoD_wVtoq")

# OR initialize with proxies

# proxy_dict = {
#           "http"  : "http://127.0.0.1",
#           "https" : "http://127.0.0.1",
#         }
# push_service = FCMNotification(api_key="<api-key>", proxy_dict=proxy_dict)

# Your api-key can be gotten from:  https://console.firebase.google.com/project/<project-name>/settings/cloudmessaging

# registration_id = "<device registration_id>"
# message_title = "Uber update"
# message_body = "Hi john, your customized news for today is ready"
# result = push_service.notify_single_device(registration_id=registration_id, message_title=message_title, message_body=message_body)

# print(result
 
# Send to multiple devices by passing a list of ids.

registration_ids = ["ewEDOBTYu-w:APA91bG-Gc9SZPT7YY82jubMJ-WYWfpfSe3JXc1T9oSuWQpwoIe1DZjrveXnOcagCdM3Px0iWVqSBqSvM1qWvBQy3bw9U3Ad8897qu3ZHSRVkwX_29oBxbhjTlmqoyrlIcRpHC8t9JgE"]
message_title = "Sanskar"
message_body = "Chutiya hai"
result = push_service.notify_multiple_devices(registration_ids=registration_ids, message_title=message_title, message_body=message_body, message_icon="facebook.png")

# data_message = {
#     "Nick" : "Mario",
#     "body" : "great match!",
#     "Room" : "PortugalVSDenmark",
# }
# result = push_service.notify_multiple_devices(registration_ids=registration_ids, data_message=data_message)

print(result)