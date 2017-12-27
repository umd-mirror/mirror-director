# Architecture

## Models

 - Project
     + Human-use Name
     + Computer-use Name (directory name, etc)
     + Homepage URL
     + Instructions and/or notes
 - Schedule
     + (cron format?)
     + Use Jenkins-style "H" for "pseudorandom time based on hash of name"?
 - Repository
     + ProjectId
     + ScheduleId
     + Human-use Name
     + Computer-use Name
     + Type (rsync/aptmirror/etc?)
     + Upstream Path
     + NOTES (For example, allow keeping records of alternate URLs that have been used)
 - JobLog
     + ProjectId
     + RepositoryId
     + Per-project counter
     + Output text
     + Result code
     + Performance counters?
 - Page - GENERATED TO STATIC HTML
     + Title
     + Body
     + ?
 - Form - allow users to submit data from custom forms
 - NewsItem
     + Title?
     + Timestamp
     + Body
     + Link? (for more info)

Project, Schedule, and Repo should use ActivityLog. Page and Form should probably use it too. There is no need for JobLog to use it. What about NewsItem?

## Notes

 - We need to generate the pages to static pages for performance. That way, try_files is faster for the main site since there's no PHP fallback. We should either use a separate subdomain for the admin app, or we should only have the app load from a subdirectory (like `/_admin`).
