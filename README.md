CRON SCHEDULER
==============
User friendly symfony bundle that helps you schedule jobs

Usage
-----
Just tag a service like this:

*JSON*
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
service_id:
    class: Namespace\Class
    tags:
        - { name: tmas.cron.job, method: methodToBeCalled, repetition: daily at 20:30 }
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
*XML*
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
<service id="service_id" class="Namespace\Class">
    <tag name="tmas.cron.job" method="methodToBeCalled" repetition="daily at 20:39" /> 
</service>
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

You can use the following ways to repeat

1. hourly at minute 5 
2. daily at 16:30
3. weekly on monday at 16:30

To-do
-----
* new way to repeat: "every 5 minutes"
* Monthly and yearly repetition
