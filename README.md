🧩 Polylang RestAPI Helper (MVC WordPress Plugin)

The polylang-restapi-helper plugin is a perfect, focused example of the [ATA MVC WordPress Plugin Framework](https://www.globaliser.com/ata/) in action. Its purpose is simple: to expose some of the Polylang plugin’s functions through the WordPress REST API.

⸻

🔧 How It Applies the ATA Concepts

🧭 Main Controller

Files:
	•	polylang-restapi-helper.php
	•	app/controllers/polylangrestapihelper-controller.php

The plugin follows the Main Controller pattern.
The root PHP file instantiates PolylangRestapiHelperController, which serves as the entry point for the entire plugin.

⸻

📡 API Class

File:
	•	app/apis/polylangrestapihelper-api.php

This is the heart of the plugin.
The PolylangRestapiHelperApi class contains logic for:
	•	Handling incoming requests
	•	Calling Polylang’s core functions
	•	Sending back formatted JSON responses

⸻

🚦 Routes

File:
	•	app/routes/main-routes.php

This file acts as the routing switchboard, mapping REST endpoints like:

/get-post-lang-relations/123

to the appropriate method inside the PolylangRestapiHelperApi class.

⸻

🚫 No Views or Services

This plugin does not have:
	•	app/views/
	•	app/services/

Why?
	•	It has no UI
	•	Its logic is simple enough to be kept inside the API class
	•	In more complex plugins, the logic inside API methods would be delegated to a Service class

⸻

🧪 Learn from the Code

By exploring the polylang-restapi-helper source code, you’ll see a direct, practical application of ATA’s core principles — making it a valuable reference for building structured and scalable WordPress plugins.
