Dropzone.options.dropzone =
{
    renameFile: function(file) {
        var dt = new Date();
        var time = dt.getTime();
        return time+file.name;
    },
    acceptedFiles: ".jpeg,.jpg,.png,.gif",
    queuecomplete: function(file, response) 
    {
        window.location.href = filelist;
    },
    error: function(file, response)
    {
       return false;
    }
};