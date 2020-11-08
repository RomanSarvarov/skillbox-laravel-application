Echo
    .private('App.User.Admin')
    .listen('.events.post-updating', function (e) {
        modalService.modalShow(e.message, e.title);
    });