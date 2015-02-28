#ResqueBoard

  *** Warning ***
  Experimental and quick branch to refactor out Cube from RB.
  Does *NOT* support any of the graphs/stats. Is *NOT* backward compatible.
  Might just burn your toast, flood your internet connection and end your latest FTL run,
  You have been WARNED!

ResqueBoard is an analytics software for PHP Resque. Monitor your workers health
and job activities in realtime.

Unlike the [original resque](https://github.com/defunkt/resque/#the-front-end), 
hat display only what's happening right now, ResqueBoard remembers and saves  
everything to compute metrics about your jobs and workers health in realtime.

Learn more on the [official website](http://resqueboard.kamisama.me), or take
a look at the [demo](http://resque.kamisama.me/).

##Goals
ResqueBoard is built for 2 objectives :

* see what's happening right now in realtime
* visualize what's happened in the past with various charts, to easily benchmarks
and balance your workers

##Minimum requirements

Although ResqueBoard is easy to install and run, you should not run it on a very 
basic webserver. It requires a minimum of processing power and memory for the 
various computation, and data storage.
