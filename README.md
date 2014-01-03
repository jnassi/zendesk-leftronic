zendesk-leftronic
=================

Zendesk likes to make data available for "the last 24 hours" in their dashboards, instead of "today". When I tried to make relevant information available to support agents through a Leftronic dashboard, I had to come up with my own method for tracking two metrics that I consider key:

- Tickets Assigned Today
- Tickets Solved Today

The method works the same for each metric.

PHP/MySQL setup
---------------
1. Create your MySQL database, and update db_config.php with your relevant values.
2. Use zendesk.sql to create your new tables, 'zendesk_assigned' and 'zendesk_solved'.
3. Add your PHP code in a location that's accessible for Zendesk targets to POST. Zendesk does allow for basic authentication if you so desire.
4. Add a Leftronic custom data source, using the Leaderboard widget, API pull mode from URL YOUR_URL/assigned-json-counter.php?format=json
5. Add a Leftronic custom data source, using the Leaderboard widget, API pull mode from URL YOUR_URL/solved-json-counter.php?format=json


Zendesk setup for Tickets Assigned Today:
-----------------------------------------------

1. Set up a Target in Zendesk
- Title = Update Counter for Tickets Assigned Today (Leftronic Dashboard)
- Url = YOUR_URL/assigned-counter.php
- Method = POST
- Attribute Name = id
- Add a Trigger to Zendesk
- Meet all of the following conditions, where Ticket: Assignee is Changed
- Perform these actions, using Notify Target to notify the "Update Counter for Tickets Assigned Today (Leftronic Dashboard)" target, with the Message consisting of:  {{ticket.id}}:::{{ticket.assignee.name}}


Zendesk setup for Tickets Solved Today:
---------------------------------------------

1. Set up a Target in Zendesk
- Title = Update Counter for Tickets Solved Today (Leftronic Dashboard)
- Url = YOUR_URL/solved-counter.php
- Method = POST
- Attribute Name = id
- Add a Trigger to Zendesk
- Meet all of the following conditions, where Ticket: Status is Changed to Solved
- Perform these actions, using Notify Target to notify the "Update Counter for Tickets Solved Today (Leftronic Dashboard)" target, with the Message consisting of:  {{ticket.id}}:::{{ticket.assignee.name}}

Known Issues
------------

No timezone handling. Your definiton of "today" will be determined by the web server / database server (not sure which).