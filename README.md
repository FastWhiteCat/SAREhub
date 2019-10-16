SAREhub is a marketing automation tool, which will help you increase your sales
and gather data about your customers’ behavior, interests, and preferences. Thanks
to vast variety of communication methods you can build a relationship with your
clients and send them personalized content and offers.

SAREhub through a virtual dashboard allows you to plan single- or omnichannel
campaigns using simple drag &amp; drop method (flowcharts). Thanks to constant data
processing you can then activate those campaigns in real-time. System is also
capable of managing lead nurturing, lead scoring scenarios. It will track users’
actions providing them with personalized communication based on the previously set
scoring. Those are just a few capabilities of the SAREhub.


### Installing the extension for Magento 2.x

#### Step 1

Installing via a composer (NOTE: These steps are only necessary when installing our software for the first time)

`composer require fastwhitecat/sarehub`


#### Step 2

1. Open command prompt (CLI)
2. Navigate to Magento 2 root directory and run the following commands:

    a. Activate Module
    
    `php bin/magento module:enable Fwc_SAREhub`

    b. Upgrade Magento extension(s)
    
    `php bin/magento setup:upgrade`

    c. Re-compile Magento files:

    `php bin/magento setup:di:compile`

    d. Re-deploy static content

    `php bin/magento setup:static-content:deploy`

    e. Clear Magento cache

    `php bin/magento cache:clean`

3. NOTE: For more details about installing custom modules check https://devdocs.magento.com/guides/v2.2
4. If you face any issues, try running following command


### Uninstall

`php bin/magento module:uninstall Fwc_SAREhub`


### How do I connect my SAREhub account with Magento?

1. Log into your SAREhub account.
2. Go to Integration → SAREweb
3. Copy the tracking code.
4. Log into your Magento administrative panel.
5. Click Store → Configuration. 
6. Click FWC EXTENSIONS → SAREhub Integration. Enter your tracking code
7. Click Save Config.
8. Please go to Cache Management and refresh cache types.

### Changelog

##### 1.0.1 - Fixed javascript file