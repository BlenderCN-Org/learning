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
• ELO.php - a standalone, browser-based, file which explores the algorithm in detail.  It would be redundant to explain more here.<br />
• index.php - The first page of my ELO example, which would later become the first main page of the project.  This page recreates (or at least attempts to) Facemash, the precursor to Facebook, which is simply a program which presents the user with two images, of whom the user selects the winner, and the program scores using the ELO algorithm, and repeats.  This implementation only uses about half of the ELO implementation FIDE uses to calculate rankings.<br/>
• index_formal.php - This is the full version of the ELO formula (the one found on Wikipedia), and mimics the same version of ELO that FIDE uses for chess rankings.<br/>

<hr>

<strong>What I've learned about the ELO formula:</strong><br />

• The ELO formula from Wikipedia doesn't seem to play nicely with negative numbers, and I didn't know why at first, but it's not because of the ELO algorithm, but the separate scoring formula used along with it (every game, the loser takes all of the winners points, plus 400, but if it goes negative, this obviously becomes a problem.  I really wonder how other software implementations deal with this).<br />
• ELO itself doesn't necessarily determine the number of points lost or gained (as far as I can tell), and just serves as a predictor of who will win.  However, the predicted ELO score may be part of the score distribution equation (and probably will be, to make sure the underdog gets more points than a player who is not, upon winning).<br />
• Even simple algorithms can sometimes be confusing and hard to implement programmatically and practically.<br/><br/>

<strong>What I'm doing next:</strong><br />
<strong>In this version:</strong><br />
• Create dropdown box to select, and limit, number of players.<br />
• Finish separate scoreboard.<br />
• Add more players.<br />
• Creating a little CSS for cosmetic purposes, but not much since I want to modernize it more anyway.<br />

<strong>Other Versions (of index.php):</strong><br />
• <strike>Possible version that uses FIDE's implementation of ELO</strike><strong> (DONE - 8/7/2019)</strong>.<br />
• Possible NodeJS version, to see how this would work differently.<br />
• Doppleganger version, and thinking about how to implement that in current version.<br/>
<br />
