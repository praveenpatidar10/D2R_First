var feed = new Instafeed({
    limit: 12,
    resolution: 'high_resolution',
    target: "instagramfeedPlaceholder",
    accessToken: 'IGQVJWZAXFYbmhtQy1OZAGZAPTjFrU3lacnBpSmVJOHRMRjJiNEZApbHJhRzV5VFIzdUl1QklzR3d3NEd4eE9acWZA5T2tJWVNWV21Oa0dibUdvTGQ5MllwUlcxT21iR1ZALOE9VVWRvdlY1NzBOampFdXZAsMwZDZD',
    transform: function(item) {
      var d = new Date(item.timestamp);
      item.date = [d.getDate(), d.getMonth(), d.getYear()].join('/');
      return item;
    }
  });
feed.run();
