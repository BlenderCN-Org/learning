<strong>Questions People May Have:</strong><br />
• <strong>Is this project done/working?</strong> Kind of (technically yes), but it's a little buggy and rough.  It does work, however.  If you want to run it, just clone/download this whole folder/repo, since some files had to be created manually at first.<br/>

<strong>Why I made this:</strong><br />
I did this just to see how algorithms and formulas are used.  I feel like I've learned a lot from this project.

<strong>When I thought of this:</strong><br />
While watching the movie <a href="https://www.imdb.com/title/tt1285016/">The Social Network</a>, about Mark Zuckerberg when he founded Facebook while at Harvard, I saw the part where they come up with the initial idea for Facemash, a website which would later be used to rate pictures of girls at Harvard (similar to <a href="https://en.wikipedia.org/wiki/Hot_or_Not">Hot or Not</a>, a more popular version), which was actually a precursor to Facebook.  During one of the scenes, Mark consults with his friend about the algorithm, which is written on a blackboard.  Since the movie glorifies the algorithm, I wanted to explore it further and actually apply it to some kind of app, and what better than similar to the original Facemash, which used the original algorithm?  At the time of this writing, there isn't any sites I could find that makes use of it, but only pages that discuss it.

Here is a still image from the movie of the algorithm on the blackboard: https://i.pinimg.com/originals/fc/ff/a0/fcffa093c3ba1dd02ebda0e5a83388c1.png

Note:  I did NOT write/invent the ELO rating formula/algorithm.  I am just studying and applying it since it's been used in software numerous times.  Also, this isn't a production-ready scalable website, but this all probably goes without saying.

<hr>

<strong>Description of Files:</strong><br />
• <strong>ELO.php</strong> - a standalone, browser-based, file which explores the algorithm in detail.  It would be redundant to explain more here.<br />
• <strong>index.php</strong> - The first page of my ELO example, which would later become the first main page of the project.  This page recreates (or at least attempts to) Facemash, the precursor to Facebook, which is simply a program which presents the user with two images, of whom the user selects the winner, and the program scores using the ELO algorithm, and repeats.  This implementation only uses about half of the ELO implementation FIDE uses to calculate rankings.<br/>
• <strong>index_formal.php</strong> - This is the full version of the ELO formula (the one found on Wikipedia), and mimics the same version of ELO that FIDE uses for chess player rankings.<br/>

<hr>

<strong>What I've learned about the ELO formula:</strong><br/>
• The ELO formula, when fully implemented, is way better than anything I could personally create.  No wonder it was used for this purpose.  It's like magic.<br/>
• The ELO formula doesn't seem to play nicely with negative numbers, and this is pretty much confirmed by the fact that FIDE doesn't allow ratings below 1000 to be used (in mind).  It's not negative numbers themselves, but the fact that the formula just doesn't work well when the starting score isn't in the 1000-2000 range.  Nothing says ELO can't be used with negative numbers, but just that it doesn't give the best results when you do this.  I'm still seeing if there are any problems with negative numbers specifically, however, but this isn't priority right now since I've pretty much got down how this formula works.<br />
• The ELO formula is actually two parts.<br />
• Even simple algorithms can sometimes be confusing and hard to implement programmatically.

<hr>

<strong>What I'm doing next:</strong><br /><br/>
<strong>In these versions:</strong><br />
• <strike>See if negative numbers affects FIDE implementation of ELO.</strike> (Solved, see "What I've Learned")<br/>
• Create dropdown box to select, and limit, number of players (?).<br />
• <strike>Finish separate scoreboard.</strike> (DONE - 8/12/2019)<br />
• Add more players.<br />
• <strike>Add thing so prediction isn't displayed until after user chooses, or so there's an option for the user to not see it.</strike> (DONE - 8/12/2019)<br/>
• Creating a little CSS for cosmetic purposes, but not much since I want to modernize it more anyway.<br />
• Add Simple Counter to see how many times each was chosen before reset, and add corresponding code to reset function.<br/>
• After counter is added, will be able to add % and # of players who choose Player 1 versus 2 (another metric to compare the ELO function to).<br/>
• Add hints for players, in case they don't know their names (what movie they're from, etc.)<br/>
• Make "true" player indicators cosmetically better.<br/>

<strong>Other Versions:</strong><br />
• Mobile version, using front-end framework.<br/>
• Scalable version.<br/>
• Database-backed version.<br/>
• <strike>Possible version that uses FIDE's implementation of ELO</strike><strong> (DONE - 8/7/2019)</strong>.<br />
• Possible NodeJS version, to see how this would work differently.<br />
• <strike>Doppleganger version, and thinking about how to implement that in current version.</strike> (DONE)<br/>
<br />
