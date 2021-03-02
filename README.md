# fritzsoap

**Attention!** A word in advance: This version 2.x has a completely changed class structure and therefore a new instantiation of the classes and their SOAP-clients (see [Usage](#usage))

## Purpose

This class provides functions to read and manipulate data via TR-064 interface on FRITZ!Box routers from [AVM](https://en.avm.de/).
Due to the large number of **actions** provided (more than 400 - depending on your FRITZ!Box model), only a few of them are **coded as functions** ready for use!

## Excerpt

With the instantiation of the class, **all available services of the addressed FRITZ!Box are determined**. So you just have to take care of little, to perform the desired action.
The services and actions are provided in a compressed form as XML and can be output with `getServiceDescription()`.

Example output:

![alt text](assets/services_xml.jpg "overview of services and actions")

The matching SOAP client only needs to be called with the instantiation of its class and gets automatically the correct **location** and **uri** from this XML.
So you just need to know what **action** you need and in what **service** it is provided. Than  you know which class you need to instantiate - **that is the difficult part**!
For reference, it is highly recommended to consult the [information AVM provides for interfaces](https://avm.de/service/schnittstellen/)!

If no coding has been done for your desired action in this class - which is probably the case - the existing examples (see [Completion](#completion)) should show how easy it is to complete the code of that function for your desired action (**contributions to extend this class are highly appreciated!**).
In the vast majority of cases, it is sufficient to adapt the message for a possible error, since the actions mainly provide arrays with return values that can be further processed by the calling program.

In addition, this class uses [fbvalidateurl](https://packagist.org/packages/blacksenator/fbvalidateurl). So you do not have to worry about whether you enter the router address with or without scheme (`http://`/`https://`), with hostname (`fritz.box`) or IP (`192.168.178.1`). Based on the validated URL, the **correct SOAP port** is also determined automatically!

## Inheritance

`fritzsoap.php` is the main class providing general basic objects. All other subclasses are extension of this class. You usually use this subclasses. **Each subclass refers to exactly one service!**

## Genesis

Please note: **All subclasses were originally generated by a program!**
Base of this generation are the service description files (XML) of my FRITZ!Box 7590. That was the easiest and flawless way to transfer the large amount of services and their actions into a generic structure of classes.

### Completion

Round about 5% of the actions are reviewed and coding is ready to use. If so, you will find in the class header comment:
`THIS FILE IS AUTOMATIC ASSEMBLED BUT PARTLY REVIEWED!`
In all other cases:
`THIS FILE IS AUTOMATIC ASSEMBLED!`
if this class is still generic.

You will see if a function coding has been checked, when you look at the comments. In all other cases untouched functions are looking like the following example of an unreviewed function (from `x_homeauto.php`):

```PHP
/**
 * setSwitch
 *
 * automatically generated; complete coding if necessary!
 *
 * in: NewAIN
 * in: NewSwitchState
 *
 */
public function setSwitch()
{
    $result = $this->client->SetSwitch();
        if ($this->errorHandling($result, 'Could not ... from/to FRITZ!Box')) {
            return;
        }

    return $result;
}
```

* First thing to point out: the function name matches the name of the action - following php coding rules (first char lower case and no hyphens).
* Secondly: you will find the input or output parameter (arguments) in the comment section of the function - if it has any.

To facilitate the completion of this creation take a look at the finished functions to transfer the use of the input and output parameters and to adjust the return of the function (`x_contact.php` is the most productive source at the moment).

Just one example to show the usage of input parameters:

```PHP
$result = $this->client->AddPhonebook(
    new \SoapParam($name, 'NewPhonebookName'),
    new \SoapParam($phoneBookID, 'NewPhonebookExtraID')
);
```

But as I said before:

* it is highly recommended to consult the information [AVM provides for interfaces](https://avm.de/service/schnittstellen/) -  even if **the documentation** offered there **is horrible and has a number of inconsistencies!**
* contributions are highly appreciated. Share your enhancements! With your PR, everyone benefits from further completion!

### Ghosts

Automatic generation has also originate services that are not or not clearly documented by AVM. Accordingly, these classes have **no link to a reference document in the class comment!**

#### AURA (AVM USB Remote Access)

So far there is one exception: AURA. Through a [thread in the IP Phone Forum](https://www.ip-phone-forum.de/threads/v0-4-1-30-09-2009-fritzboxnet-net-bibliothek-f%C3%BCr-fritz-box.190718/) I learned how this service works. The six actions of this service are coded and an [unofficial documentation](docs/auraSCPD.pdf) can be found in the `/docs` folder.
You must have activated the USB remote access function in the FRITZ!Box to be able to access this service!

#### Control

This group of ghosts includes the >Control< services, of which I found seven with different locations and uri. The services are therefore mapped accordingly in the classes Control1 to Control7. **With the concept of this library, the use of these actions is not (yet) possible** (the Voigt-Kampff test has not yet been implemented)! **If you want to use these undocumented actions, you have to intervene in the program with code change!**

#### Other ghosts

* any (has no actions)
* avmnexus
* fritzbox
* WANCommonIFC1
* wancommonifconfig1
* wandslifconfig1
* WANDSLLinkC1
* wandsllinkconfig1
* WANIPConn1
* wanipconnection1
* WANIPv6Firewall1
* x_hostfilter
* x_remote

## Requirements

* PHP 7.3 or higher
* Composer (follow the installation guide at <https://getcomposer.org/download/)>

## Installation

You can install it through Composer:

```js
"require": {
    "blacksenator/fritzsoap": "^2.4"
},
```

or

```console
git clone https://github.com/blacksenator/fritzsoap.git
```

## Usage

Example if you wanna get a file with your available services:

```PHP
require_once('vendor/autoload.php');

use blacksenator\fritzsoap\x_contact;

$fritzbox = new x_contact($url, $user, $password);
$services = $fritzbox->getServiceDescription();
$services->asXML('services.xml');
```

**Hint:** The function `getServiceDescription()` is available in all classes!
You can also get a more detailed structure with `getServiceDescription(true)`. In this case, the information from the FRITZ!Box is gathered again and all parameters of the actions are also output, as well as the file name of the XML from which the information originates.
Example output:

![alt text](assets/detail_xml.jpg "details about services and actions")

Example to get a list of all your network devices:

```PHP
$fritzbox = new hosts($url, $user, $password);
$fritzbox->getClient();
$meshList = $fritzbox->x_AVM_DE_GetMeshListPath();
```

Example to dial a number (connected to one of your phone devices):

```PHP
$fritzbox = new x_voip($url, $user, $password);
$fritzbox->getClient();
$fritzbox->x_AVM_DE_DialNumber('#9');
```

### Performance

With each instantiation of a subclass, the services of the FRITZ!Box are determined and transformed into the above-mentioned XML. If different classes are used in one program, then **repeating this time-consuming process should be avoided!**
This can be achieved by passing the services to the next class when instantiated:

```PHP
$classA = new aura($url, $user, $password);
$classA->getClient();
$classA->getVersion();
...
$services = $classA->getServiceDescription();
$classB = new x_contact($url, $user, $password, $services);
$classB->getClient();
$classB->getInfo();
```

## License

This script is released under MIT license.

## Author

Copyright (c) 2019 - 2021 Volker Püschel
