<?php
// This file was auto-generated from sdk-root/src/data/s3/2006-03-01/paginators-1.json
return [ 'pagination' => [ 'ListBuckets' => [ 'result_key' => 'Buckets', ], 'ListMultipartUploads' => [ 'limit_key' => 'MaxUploads', 'more_results' => 'IsTruncated', 'output_token' => [ 'NextKeyMarker', 'NextUploadIdMarker', ], 'input_token' => [ 'KeyMarker', 'UploadIdMarker', ], 'result_key' => [ 'Uploads', 'CommonPrefixes', ], ], 'ListObjectVersions' => [ 'more_results' => 'IsTruncated', 'limit_key' => 'MaxKeys', 'output_token' => [ 'NextKeyMarker', 'NextVersionIdMarker', ], 'input_token' => [ 'KeyMarker', 'VersionIdMarker', ], 'result_key' => [ 'Versions', 'DeleteMarkers', 'CommonPrefixes', ], ], 'ListObjects' => [ 'more_results' => 'IsTruncated', 'limit_key' => 'MaxKeys', 'output_token' => 'NextMarker || Contents[-1].Key', 'input_token' => 'Marker', 'result_key' => [ 'Contents', 'CommonPrefixes', ], ], 'ListObjectsV2' => [ 'limit_key' => 'MaxKeys', 'output_token' => 'NextContinuationToken', 'input_token' => 'ContinuationToken', 'result_key' => [ 'Contents', 'CommonPrefixes', ], ], 'ListParts' => [ 'more_results' => 'IsTruncated', 'limit_key' => 'MaxParts', 'output_token' => 'NextPartNumberMarker', 'input_token' => 'PartNumberMarker', 'result_key' => 'Parts', ], ],];
