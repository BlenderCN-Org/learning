<strong>Questions People May Have:</strong><br />
• <strong>Is this project done/working?</strong> Kind of (technically yes), but it's a little buggy and rough.  It does work, however.  All files must be created manually first since no checking is programmed in, etc.  If you want to run it, just clone ths whole folder/repo.<br/>

<strong>Why I made this:</strong><br />
I did this just to see how algorithms and formulas are used.  I feel like I've learned a lot from this project.

<strong>When I thought of this:</strong><br />
While watching the movie <a href="https://www.imdb.com/title/tt1285016/">The Social Network</a>, about Mark Zuckerberg when he founded Facebook while at Harvard, I saw the part where they come up with the initial idea for Facemash, a website which would later be used to rate pictures of girls at Harvard (similar to <a href="https://en.wikipedia.org/wiki/Hot_or_Not">Hot or Not</a>, a more popular version), which was actually a precursor to Facebook.  During one of the scenes, Mark consults with his friend about the algorithm, which is written on a blackboard.  Since the movie glorifies the algorithm, I wanted to explore it further and actually apply it to some kind of app, and what better than similar to the original Facemash, which used the original algorithm?  At the time of this writing, there isn't any sites I could find that makes use of it, but only pages that discuss it.

Here is a still image from the movie of the algorithm on the blackboard: https://i.pinimg.com/originals/fc/ff/a0/fcffa093c3ba1dd02ebda0e5a83388c1.png

Note:  I did NOT write/invent the ELO rating formula/algorithm.  I am just studying and applying it since it's been used in software numerous times.  Also, this isn't a production-ready scalable website, but that probably goes without saying.

<hr>

<strong>Description of Files:</strong><br />
• ELO.php - a standalone, browser-based, file which explores the algorithm in detail.  It would be redundant to explain more here.<br />
• index.php - The first page of my ELO example, which would later become the first main page of the project.  This page recreates (or at least attempts to) Facemash, the precursor to Facebook, which is simply a program which presents the user with two images, which the user then rates, and the program scores using the ELO algorithm, and repeats.  This implementation only used about half of the ELO implementation FIDE uses to calculate rankings.

<hr>

<strong>What I've learned about the ELO formula:</strong><br />

• I didn't know as much about the forumula/algorithm as I thought, but think I pretty much got it now.<br/>
• There are actually different implementations of the "ELO formula" (such as FIDE, an official implementation of the ELO algorithm/formula).<br/>
• The ELO formula from Wikipedia doesn't seem to play nicely with negative numbers, and I didn't know why at first, but it's not because of the ELO algorithm, but the separate scoring formula used along with it (every game, the loser takes all of the winners points, plus 400, but if it goes negative, this obviously becomes a problem.  I really wonder how other software implementations deal with this).<br />
• ELO itself doesn't determine the number of points lost or gained (as far as I can tell), and just serves as a predictor of who will win.  As I just mentioned, there is a separate scoring formula used, which can be different depending on which implementation of ELO you're using (as I said on the line that mentioned FIDE).<br />
• I didn't realize this before this experiment, but I'm sure ELO (or something like it) is how some websites make content suggestions, although most likely astronomically more complex on bigger sites (I don't see why it can't be used on a large scale, however, aside from its other limitations, like being only able to be used in "zero-sum" games).<br />
• I know I'm not using this algorithm exactly how most implementations do, like FIDE (mostly just the scoring forumula I just mentioned twice above), but I think it works well in the way I used it for this application.  I actually think my implementation works better, but I'm sure it's nothing great.  I will attempt to make a "pure FIDE" version in the future when I have more time.<br /><br />

<strong>What I'm doing next:</strong><br /><br />
<strong>In this version:</strong><br />
• Create dropdown box to select, and limit, number of players.<br />
• Finish separate scoreboard.<br />
• Add more players.<br />
• Creating a little CSS for cosmetic purposes, but not much since I want to modernize it more anyway.<br />

<strong>Other Versions (of index.php):</strong><br />
• Possible version that uses FIDE's implementation of ELO.<br />
• Possible NodeJS version, to see how this would work differently.<br />
<br />
