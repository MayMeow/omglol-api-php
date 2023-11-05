# OMG.lol API client

API library for OMG.lol made with PHP

### StatusLog service

Service is available within `MayMeow\Omglol\Services\StatusLogService` class. Check for supported actions in table below

| Action | Available | Example|
| ---- | ---- | ---- |
|Retrieve an individual status for an address| ✅ | `getSIngleStatus('may', '63d40f2b35314')` |
|Retrieve all statuses for an address| ✅ | `getAllStatuses('may')` |
|Share a new status| | |
|Share a new status from a single status string| | |
| Update an existing status | | |
| Retrieve a Statuslog bio | ✅ | `getBio('may')` |
| Update a Statuslog bio | | |
| Retrieve the entire statuslog | ✅ | `getAllStatuses()` Do not define address to getentrie statuslog |
| Retrieve everyone’s latest status | ✅ | `getLatest()` |