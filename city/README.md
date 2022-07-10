# Ideas to Improve City Government Functionality on the BBS Website
## Written by: Shaun Loftin, Last Updated: 07/10/2022

***

## City Government Manager
Using the existing admin dashboard infrastructure, we could allow city government members to update the website content for their specific city. This would allow city constituents to better understand what is happening in government while giving the City Clerks more meaningful tasks to do.

### Clerk to Council to Update Legislative Content
The Clerk to Council can go in and update content from the city council. This would include minutes, resolutions/ordinances and whether or not they are in their 1st/2nd reading, upcoming meeting dates and times, and upcoming agendas.

### Clerk to Mayor to Update Daily Report Content
The Clerk to the Mayor would be responsible for collecting daily reports prior to the meeting time and uploading them to the website. This would allow their peers to better see what is happening in the city government and would save some paper in printing each individual one.

***

## City Government Status Report
Based on the content uploaded to the website, we can create a printout for city counselors to post on their bulletin board. Once the Clerk to Council and Clerk to Mayor upload their daily content as mentioned above, we run a program (likely Python?) that puts it all into a neatly formatted and summarized PDF. These PDFs are printed off and put in counselor mailboxes prior to 3:45. Possible sections of this status report could be: City Government Ordinances/Resolutions Passed, One-Sentence Summaries of Cabinet Reports, Action Items for Tomorrow.

### Extrapolating this Idea to Other Sections
This would take some reconfiguring of the database but what if on this printout, we were able to see which people in our city passed bills in Legislature? or passed bills in County Government? or saw printed out status reports from the State Government?

We would need the database to reflect which legislature delegates are from what city. Then, at the end of the day, when we run that "City Government Status Report", it would also search bill progress from that city as well to include.

***

Just some ideas, nothing set in stone. Just brainstorming out loud. :-)