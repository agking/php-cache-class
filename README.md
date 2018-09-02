# CloudFusion 3.1

**CloudFusion is the AWS SDK for PHP, plus some other stuff.**

When [Amazon Web Services](http://aws,amazon.com) forked CloudFusion to create the [AWS SDK for PHP](http://aws,amazon.com/sdkforphp), they effectively took over the primary development of all infrastructure-related services. The Amazon services that are not related to infrastructure (e.g. [Amazon Product Advertising API](http://aws,amazon.com/associates)), as well as support for third-party API-compatible services (e.g. [Eucalyptus](http://open.eucalyptus.com), [Google Storage](https://code.google.com/apis/storage/)) are maintained by the community as part of CloudFusion.

Most of the improvements will come from Amazon in the form of updates to the AWS SDK for PHP. Additions that are specific to CloudFusion will be updated as needed, but won't be very often. Mostly, we'll simply pull in the latest changes from the [AWS GitHub account](http://github.com/amazonwebservices/aws-sdk-for-php).


## You Should Prefer the AWS SDK for PHP over CloudFusion

Unless you're explicitly using the extra classes that CloudFusion provides, I would highly encourage you to watch/fork the [official SDK repository](http://github.com/amazonwebservices/aws-sdk-for-php) instead of CloudFusion. Let's show our support for the Amazon SDK team.

CloudFusion does not make any changes to the AWS SDK for PHP -- we only add a few classes, and a few CloudFusion-specific entries to the configuration file. If you're only using AWS infrastructure services, you gain nothing by using CloudFusion over the AWS SDK for PHP.


## Enabling CloudFusion Extensions

If you're extending CloudFusion or the AWS SDK for PHP with a class prefixed with `Amazon` or `CF`, you can add it to the `services` or `utilities` directory, respectively.

For classes that don't follow this pattern (e.g., `GoogleStorage()`) you'll need to add them to the `extensions` directory, then explicitly enable the `AWS_ENABLE_EXTENSIONS` option in your configuration file. It is _not enabled by default_.

**NOTE:** The `AWS_ENABLE_EXTENSIONS` configuration option is _very_ greedy autoloader and will attempt a catch-all. If enabled, make sure that `sdk.class.php` is loaded _last_ to avoid clobbering any other autoloaders. Alternatively, you can leave the `AWS_ENABLE_EXTENSIONS` disabled by manually including the new class in your project.


## Which is Which?

The code that is part of the AWS SDK for PHP vs. CloudFusion is broken up like so.

### CloudFusion

<table border="1" cellpadding="3">
	<thead>
		<tr>
			<th>Service</th>
			<th>Location</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Amazon Product Advertising API</td>
			<td><code>services/pas.class.php</code></td>
		</tr>
		<tr>
			<td>Google Storage</td>
			<td><code>extensions/googlestorage.class.php</code></td>
		</tr>
		<tr>
			<td>Eucalyptus</td>
			<td><code>extensions/eucalyptus.class.php</code></td>
		</tr>
		<tr>
			<td>Walrus</td>
			<td><code>extensions/walrus.class.php</code></td>
		</tr>
	</tbody>
</table>

Everything else is part of the AWS SDK for PHP.


## Getting Help

Anything that is related to the AWS SDK for PHP should be directed to the [PHP Development Forum](http://developer.amazonwebservices.com/connect/forum.jspa?forumID=80).

For anything related to the Amazon Product Advertising API, Google Storage, Eucalyptus, or support for other non-Amazon services in CloudFusion, feel free to ask your question on the [CloudFusion Google Group](http://groups.google.com/group/cloudfusion/).


## Contributions

Again, there are Amazon classes and CloudFusion classes. Contributions to AWS SDK for PHP code needs to go through Amazon's contribution process. Contributions to the CloudFusion code can be made very simply in the form of a GitHub pull request.
