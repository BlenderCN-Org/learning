Questions People May Have:
• Is this project done/working? Yes, but it's a little buggy and rough.  It does work, however.

Why I made this:<br/>
I did this just to see how algorithms and formulas are used.  I feel like I've learned a lot from this project.

When I thought of this:<br/>
While watching the movie <a href="https://www.imdb.com/title/tt1285016/">The Social Network</a>, about Mark Zuckerberg when he founded Facebook while at Harvard, I saw the part where they come up with the initial idea for Facemash, a website which would later be used to rate pictures of girls at Harvard (similar to Hot or Not, a more popular version), which was actually a precursor to Facebook.  During one of the scenes, Mark consults with his friend about the algorithm, which is written on a blackboard.  Since the movie glorifies the algorithm, I wanted to explore it further and actually apply it to some kind of app, and what better than similar to the original Facemash, which used the original algorithm?  At the time of this writing, there isn't any sites I could find that makes use of it, but only pages that discuss it.

Here is a still image from the movie of the algorithm on the blackboard: https://i.pinimg.com/originals/fc/ff/a0/fcffa093c3ba1dd02ebda0e5a83388c1.png

Note:  I did NOT write/invent the ELO rating formula/algorithm.  I am just studying and applying it since it's been used in software numerous times.

<hr>

Description of Files:<br/>
• ELO.php - a standalone, browser-based, file which explores the algorithm in detail.  It would be redundant to explain more here.<br/>
• index.php - The first page of my ELO example, which would later become the first main page of the project.  This page recreates (or at least attempts to) Facemash, the precursor to Facebook, which is simply a program which presents the user with two images, which the user then rates, and the program scores using the ELO algorithm.  Note:  The algorithm used may not exactly be the same ELO algorithm as the original Facemash, especially the two steps of calculating the player's expected score, and updating both player's rating (and score/rating are actually two different things in terms of ELO).

<hr>

What I've learned about the ELO formula:<br/>
• There are actually many different implementations of the "ELO formula," such as FIDE.
• The ELO formula from Wikipedia doesn't seem to play nicely with negative numbers, but maybe that's just the one I'm using.
• ELO itself doesn't determine the number of points lost or gained (as far as I can tell), and just serves as a predictor of who will win.<br/>
• I didn't realize this before this experiment, but ELO (or something like it) is probably how Netflix and other websites make content suggestions, although most likely a lot more complex.
• I know I'm not using this algorithm exactly how other things would, but I think it works well in the way I used it for this application.

What I will be doing next:<br/>
• Creating a little CSS for cosmetic purposes, but not much since I want to modernize it more via NodeJS anyway.<br/>
• Possibly creating NodeJS version of this, to see how this would work asyncronously.
<br/>
