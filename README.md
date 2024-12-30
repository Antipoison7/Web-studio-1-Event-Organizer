#  Web Programming Studio 1 - Group 1 2024

[![Project Version][version-image]][version-url]
[![Backend][Backend-image]][Backend-url]
<br>
[![mySQL][mySQL-image]][mySQL-url]
[![PHP][PHP-image]][PHP-url]
[![HTML][HTML-image]][HTML-url]
[![CSS][CSS-image]][CSS-url]
[![Js][Js-image]][Js-url]

> A website and teamwork task that focuses on managing and using colaborative tools such as git in larger team sizes

This project aimed to create a website as a team that features a strong login and administration system, a chat / forum page as well as a store page / cart, each of these should use at least 2 REST APIs to demonstrate creating, reading, updating and deleting. A large part of the project is creating a strong security system focused around roles as well as which users should be able to interact with each part of the website.

---
## Authors

**Connor Orders** 
* *Primary group leader* - Managing communication issues
* *Document Manager* - Created and centralized documents using the available tools
* *User login Developer* - Developed all features relating to the login system as well as access privelages and individual profile customisation
* *Admin Module Developer* - Developed all features relating to the admin module such as post archiving and profile timeouts

**Declan Thomas**
* *Submission Organizer* - In charge of making sure the work is submitted on time as well as giving cutoff times
* *Forum Module Developer* - Assigned to be in charge of developing the forum module including comment sections and other forum features

**Himanth Venkata Sriharsha Raghavaraju**
* *REST API Specialist* - In charge of integrating REST APIs into all of the other sections

**Josip Kasic**
* *Cart Module Developer* - Developed all features relating to the shopping cart excluding the item page itself

## Showcase
![Webpage-Showcase-image]

## Original Github Details / Readme
Accounts

    Admin Account
        Username: adminAccount
        Email: admin.testing@email.com
        Password: P@ssword1

    Normal Account-
        Username: joeAverage
        Email: average.joe@email.com
        Password: P@ssword1



**Hosts**

[Connor's mirror s4096467 (most likely to be up to date)](https://saturn.csit.rmit.edu.au/~s4096467/web-studio-project-group_01_wps_2024/siteRoot/)

Josip

[Declan's mirror s4009378](https://titan.csit.rmit.edu.au/~s4009378/web-studio-project-group_01_wps_2024/siteRoot/)

[Himanth s4055688](https://saturn.csit.rmit.edu.au/~s4055688/web-studio-project-group_01_wps_2024/siteRoot/fancommunity.php)


Declan (Discussions and Events):
Please note during the assigment stage of the modules Declan was assigned to Discussion Forum, we have had some issues as Himanth as also done a discussion forum which wasnt discussed between the group and was done independently. I, Declan have tried to speak with Himanth about this but was unable to get a clear picture. Himanth was convinced his discussion module was apart of the REST API's section which he was assigned but made no effort to discuss this with the rest of the group.
Please refer to the discussionForum.php for browsing events and eventRegistration.php for regsitering events. 

Himanth- 

I want to clear up the discussion page misunderstanding. 
Although Declan was assigned the task of implementing the Discussion Forum, I was working on the REST APIs, which included API functions for my discussion page. In my implementation of the discussion page, I made sure that users could: Add new discussions, Delete discussions, Reply to other users' discussions, Like and dislike discussions, User can Add images, emojies, gifs in discussion and there are timestaps for replies, with the like and dislike counts updating in real-time. they are 
This functionality is fully integrated and operational in the discussions.php page. However, Declan's implementation of the discussion forum is not as complete as mine. Despite my efforts to discuss and clarify this, I've attempted to discuss with Declan, He told that the discussion forum was his part. and did not fully develop the features I had implemented, even though I had made my approach clear from the outset. My task was the API part, which I to covered in fancommunity page, and I also took the extra effort to fully implement a functional discussion page, as part of my assignment. This was clearly outlined in the design document from the very beginning, where I specified that my section has also a discussion page.

Discussion page (child website from fancommunity page)-
features: 
Add new discussions.
Delete discussions they’ve posted.
Reply to other users' discussions.
Like or dislike discussions (user feedback is counted and displayed in real-time).
Real-time Updates: The number of likes and dislikes on each discussion are dynamically updated whenever users interact. This ensures a seamless experience and keeps the counts current.

All these functionalities enabling users to interact with the system smoothly and securely.

Fan Community Page (User Interaction & Event Tracking)
Trending Discussions: which displays trending discussions, and navigates to discussions page

Event Galleries: I’ve integrated photo galleries for events, where users can view multiple images (e.g., a collage of 4 images per event). Each gallery has a label indicating the total number of images (e.g., '+27'), allowing users to see how many pictures have been uploaded. Additionally, users can upload their own photos to the event galleries, contributing to the growing collection of fan images. Image count updated lively.

Event Locations: Each event has a location displayed beneath the event name. This feature also includes a Google Maps link that opens the event’s location, allowing users to easily view the event on a map.

User Location: The user's current location is displayed at the top of the page, including the latitude and longitude coordinates. Users can also click a Google Maps link to view their location on an interactive map. This feature is powered by real-time geolocation data, ensuring the information is accurate.

Interactive Map: The page includes a map that shows the user’s location with a marker. Additionally, it marks the locations of various events, making it easier for users to find events near them or of interest.

Summary of My Work
The Fan Community Page and discussion page in fancommunity I’ve developed are fully functional and integrated, providing a seamless user experience. Users can interact with the system, contribute to discussions, view event galleries, and see their location in real-time. The integration of interactive maps and live updates ensures that users are engaged and have a smooth browsing experience.

In comparison, while Declan’s work on the Discussion Forum was intended to focus on certain aspects, I made sure to create a fully interactive and functional discussion page real-time data handling. I worked diligently to ensure it was integrated properly.



<!--Markdown Images and Badges-->

[Webpage-Showcase-image]: Readme-Resources/preview.png

[version-image]: https://img.shields.io/badge/Version-1.0.0-brightgreen?style=for-the-badge&logo=appveyor
[version-url]: https://img.shields.io/badge/version-1.0.0-green

[Backend-image]: https://img.shields.io/badge/Backend-PHP-important?style=for-the-badge
[Backend-url]: https://img.shields.io/badge/Backend-PHP-important?style=for-the-badge

[mySQL-image]: https://img.shields.io/badge/mySQL-07405E?style=for-the-badge&logo=mysql&logoColor=white
[mySQL-url]: https://img.shields.io/badge/mySQL-07405E?style=for-the-badge&logo=mysql&logoColor=white

[PHP-image]: https://img.shields.io/badge/PHP-ED8B00?style=for-the-badge&logo=php&logoColor=white
[PHP-url]: https://img.shields.io/badge/PHP-ED8B00?style=for-the-badge&logo=php&logoColor=white

[HTML-image]: https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white
[HTML-url]: https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white

[CSS-image]: https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white
[CSS-url]: https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white

[Js-image]: https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black
[Js-url]: https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black
