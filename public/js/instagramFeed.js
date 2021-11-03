var feed = new Instafeed({
    limit: 12,
    resolution: 'high_resolution',
    target: "instagramfeedPlaceholder",
    accessToken: 'IGQVJVTjhEbmdiMGlWSzBjMWJzcGFUS2VFZAnBSTTNSMUdQX3hNa2RPaGtZAOWNQSnQzQjBsVHhrck5qUnFZAOV9IZA0YzMUVPamRWV01WcFpWTlI5YlFlemZADampNSHkzN2lNdVZAlX1R1X1pOR0pVNlZA1VgZDZD',
    transform: function(item) {
      var d = new Date(item.timestamp);
      item.date = [d.getDate(), d.getMonth(), d.getYear()].join('/');
      return item;
    }
  });
feed.run();
