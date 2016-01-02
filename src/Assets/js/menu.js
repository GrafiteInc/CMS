function confirmLinkDelete (url) {
    $('#deleteLinkBtn').attr('href', url);
    $('#deleteLinkModal').modal('toggle');
}

function confirmDelete (url) {
    $('#deleteBtn').attr('href', url);
    $('#deleteModal').modal('toggle');
}