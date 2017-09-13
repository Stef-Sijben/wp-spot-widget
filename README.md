# Spot GPS Tracker Wordpress Widget
A Wordpress widget displaying Spot GPS tracker locations.
For an example of the widget in use see [my blog](http://blog.stfs.eu/).


After installing, you can create a widget showing the latest position updates on your blog. To configure it, you need to [obtain a Google Maps API key](https://developers.google.com/maps/documentation/embed/get-api-key) and [configure a feed for your Spot account](https://login.findmespot.com/spot-main-web/myaccount/share/). This feed must be public, i.e. not password protected.

In the widget settings you then enter the feed ID, i.e. the part after `?glId=` in the feed URL. For example, if your feed URL is

```
http://share.findmespot.com/shared/faces/viewspots.jsp?glId=0g1MK8mxl4NNmBYAnuiZPlX3JXyzuT19t
```

then the feed ID is `0g1MK8mxl4NNmBYAnuiZPlX3JXyzuT19t`.

What exactly is displayed depends on how you configure the feed in your Spot account.
