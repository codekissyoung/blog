define(['backbone'],function(Backbone){
    var model = new Backbone.Model();
    var col   = new Backbone.Collection();
    var view  = new Backbone.View();
    return {
        log: function(){
            console.log("backbone hello world log!");
        }
    };
});
