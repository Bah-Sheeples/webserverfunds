#!/usr/bin/env python
import requests

def main():
    """
    Send an SMS message for testing purposes.
    """
    phone = '+15558838530' # <-- Enter your own phone number here
    smsmsg = 'Test message using the Textbelt web API.'
    apikey = 'textbelt' # <-- Change to your API key, if desired
    # Attempt to send the SMS message.
    if send_textbelt_sms(phone, smsmsg, apikey):
        print('SMS message successfully sent!')
    else:
        print('Could not send SMS message.')

def send_textbelt_sms(phone, msg, apikey):
    """
    Sends an SMS through the Textbelt API.
    :param phone: Phone number to send the SMS to.
    :param msg: SMS message. Should not be more than 160 characters.
    :param apikey: Your textbelt API key. 'textbelt' can be used for free for 1 SMS per day.
    :returns: True if the SMS could be sent. False otherwise.
    :rtype: bool
    """
    result = True
    json_success = False
    # Attempt to send the SMS through textbelt's API and a requests instance.
    try:
        resp = requests.post('https://textbelt.com/text', {
            'phone': phone,
            'message': msg,
            'key': apikey,
        })
    except:
        result = False
    # Extract boolean API result
    if result:
        try:
            json_success = resp.json()["success"]
        except:
            result = False
    # Evaluate if the SMS was successfully sent.
    if result:
        if not json_success:
            result = False;
    # Give the result back to the caller.
    return result

if __name__ == "__main__":
    main()


# reference:
# https://www.pragmaticlinux.com/2021/02/how-to-send-an-sms-message-using-python/#:~:text=To%20send%20an%20SMS%20message%20from%20Python%2C%20we%E2%80%99ll,IDE%20and%20run%20the%20command%3A%20pip%20install%20%22requests%22 
