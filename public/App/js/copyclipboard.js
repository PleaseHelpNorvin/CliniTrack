function copyToClipboard(link) {
    navigator.clipboard.writeText(link).then(function() {
        alert('Link copied to clipboard!');
    }, function(err) {
        alert('Failed to copy link: ', err);
    });
}