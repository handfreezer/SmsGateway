**Very SIMPLE but EFFICIENT SMS gateway from HTTP(s)**

This project is a very simple gateway HTTP=>SMS and SMS=>mail , it is simply working great!

Authorisation is based on a list of token allowed to use the service, and as far as the communication is protected through a SSL certificate (TLS v1.3 at this time), I consider this is enough secured.

Received SMS are transfered to an email.

The main point of this project : it is so simple that it can be extended easily, and you don't really need to understand AT commands to use the GSM.

Also, just to tell to every one : when you're a dev'ops, monitoring your information system, if you loose you internet access, you can't use an online SMS gateway in the cloud to send an alert (email, online SMS service, twitter, IRC, ...). Think about it, and now, ask yourself : do you need a such gateway? it is only 60$ each, one hour to assemble pieces, one hour to configure ;-)

**LICENCE**

You can use, and/or modify freely, BUT, you have to share here any changes (through an issue and/or a push request). You're not allowed to use for commercial purposes in any way.

**Image & Video in docs directory**

<img alt="v1.0.0" src="https://github.com/handfreezer/SmsGateway/raw/master/docs/photo.v1.0.0.jpg" max-with="500">

**Building**

So, SMS module is connected like:
* TX and RX of SMS module are connected to the serial console of the rpi
* Adding a 1000µF/10V on SMS module, because instability may occur on PIN code init

To install, you have to:
* Create a basic debian image on a SDCard
* insert into and start your Rpi
* configure your network, I suggest you to set it in static
* update and install git
* clone the repo
* install gammu httpd python
* apply httpd-smsweb.conf.template into httpd conf dir
* apply gammu-smsdrc.template into gammu conf dir
* configure conf files template of tools directory
* configure smsctrl.config.php.template from www/php directory
* reboot and check : your GAMMU should have started and init your SMS module, waiting for message to be sent, and you should be able to send SMS through your HTTPD server (you can use tools/sendSMS.sh for testing purposes)

**Notes**
* you can change you HTTP conf to add a more sophisticated authentication method
* you should think about HA of the service by adding a second gateway :-P
* this is cost effective : about 50$ for rapsberry pi and 10$ for GSM module
* you can add a routing table for received SMS, and through other way than mail (like http post, ...)
* service is not "protected" as owner of token should be responsible, BUT this is a TODO : protecting the service from injection.

**Keywords**

sms http gateway server raspberry pi linux gammu php python shell
