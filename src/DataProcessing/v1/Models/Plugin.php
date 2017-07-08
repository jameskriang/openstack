<?php declare(strict_types=1);

namespace OpenStack\DataProcessing\v1\Models;

use OpenStack\Common\Resource\Creatable;
use OpenStack\Common\Resource\Deletable;
use OpenStack\Common\Resource\OperatorResource;
use OpenStack\Common\Resource\Listable;
use OpenStack\Common\Resource\Retrievable;
use OpenStack\Common\Transport\Utils;
use Psr\Http\Message\ResponseInterface;
class Plugin extends OperatorResource implements Listable, Retrievable
{
  public $description;
  public $versions;
  public $versionLabels;
  public $title;
  public $pluginLabels;
  public $name;
  public $tenantId;

  protected $resourceKey = 'plugin';
  protected $resourcesKey = 'plugins';

  protected $aliases = [
			'version_labels'			   	=>	'versionLabels',
			'plugin_labels'				   	=>	'pluginLabels',
			'tenant_id'					    => 'tenantId',
			'plugin_name'            		=> 'name',

	];


  	public function retrieve()
	{
		$response = $this->execute($this->api->getPlugin(), $this->getAttrs(['name']));
		$this->populateFromResponse($response);
	}

 	public function retrieveDetails()
	{
		$response = $this->execute($this->api->getPluginVersion(), $this->getAttrs(['name','versions']));

		return Utils::jsonDecode($response)['plugin'];
	}

	public function update()
	{
	 	$response = $this->execute($this->api->patchPlugin(), $this->getAttrs([]));
	 	$this->populateFromResponse($response);
	 }

}
