<?php


namespace Wix\Mediaplatform\Authentication;


class VERB
{
    const FILE_UPLOAD = NS::SERVICE . "file.upload";
    const FILE_IMPORT = NS::SERVICE . "file.import";
    const FILE_CREATE = NS::SERVICE . "file.create";
    const FILE_GET = NS::SERVICE . "file.get";
    const FILE_LIST = NS::SERVICE . "file.list";
    const FILE_DOWNLOAD = NS::SERVICE . "file.download";
    const FILE_DELETE = NS::SERVICE . "file.delete";
    const FILE_COPY = NS::SERVICE . "file.copy";

    const AV_TRANSCODE = NS::SERVICE . "av.transcode";
    const AV_REPACKAGE = NS::SERVICE . "av.repackage";
    
    const JOB_GET = NS::SERVICE . "job.get";
    const JOB_SEARCH = NS::SERVICE . "job.search";
    
    const ARCHIVE_CREATE = NS::SERVICE . "archive.create";
    const ARCHIVE_EXTRACT = NS::SERVICE . "archive.extract";
}
