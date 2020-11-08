window.modalService = {
    modalShow: function(text, title = '') {
        let $modal = $('#modal');

        $modal.find('.modal-title').html(title ? title : 'Info');
        $modal.find('.modal-body').html(text);

        $modal.modal('show');
    }
};