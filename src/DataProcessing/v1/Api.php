<?php declare(strict_types=1);

namespace OpenStack\DataProcessing\v1;

use OpenStack\Common\Api\AbstractApi;

class Api extends AbstractApi
{
	public function __construct()
	{
		$this->params = new Params();
	}
	
	public function getClusters(): array
	{
		return [
				'method' => 'GET',
				'path'   => 'clusters',
				'params' => [
						'limit'        => $this->params->limit(),
						'marker'       => $this->params->marker()
				]
		];
	}
	
	public function getCluster(): array
	{
		return [
				'method' => 'GET',
				'path'   => 'clusters/{id}',
				'params' => [
						'id'           => $this->params->urlId('cluster'),
						'limit'        => $this->params->limit(),
						'marker'       => $this->params->marker()
				]
		];
	}
	
	public function deleteCluster(): array
	{
		return [
				'method' => 'DELETE',
				'path'   => 'clusters/{id}',
				'params' => ['id' => $this->params->urlId('cluster')],
		];
	}
	
	public function patchCluster(): array
	{
		return [
				'method'  => 'PATCH',
				'path'    => 'clusters/{id}',
				'params'  => [
						'id'   => $this->params->urlId('cluster'),
						'isPublic' => $this->params->isPublic(),
						'name' => $this->params->name('cluster'),
				],
		];
	}
	
	public function postCluster(): array
	{
		return [
				'path'    => 'clusters',
				'method'  => 'POST',
				'params'  => [
						'pluginName'            => $this->params->pluginName(),
						'hadoopVersion'           => $this->params->hadoopVersion(),
						'clusterTemplateId'        => $this->params->clusterTemplateId(),
						'defaultImageId'           => $this->params->defaultImageId(),
						'userKeypairId'               => $this->notRequired($this->params->userKeyPairId()),
						'name'     => $this->isRequired($this->params->name('cluster')),
						'neutronManagementNetwork'           => $this->params->neutronManagementNetwork()
				]
		];
	}
	
	public function postClusters(): array
	{
		$definition = $this->postCluster();
		$definition['path'] .= '/multiple';
		$definition['params'] = array_merge($definition['params'],[
			'count' => $this->params->count(),
			'clusterConfigs' => $this->params->clusterConfigs()	
		]);
		return $definition;
	}
	//---------------------------------------------------------------------
	public function postDataSource(): array
	{
		return [
				'path'    => 'data-sources',
				'method'  => 'POST',
				'params'  => [
						'description'		=> $this->params->dataSourceDescription(),
						'url'				=> $this->params->url(),
						'type'				=> $this->params->dataSourceType(),
						'name'				=> $this->params->dataSourceName()
				]
		];
	}
	
	public function deleteDataSource(): array
	{
		return [
				'method' => 'DELETE',
				'path'   => 'data-sources/{id}',
				'params' => ['id' => $this->params->urlId('datasource')]
		];
	}
	
	public function getDataSource(): array
	{
		return [
				'method' => 'GET',
				'path'   => 'data-sources/{id}',
				'params' => [
						'id'           => $this->params->urlId('datasource')
				]
		];
	}
	
	public function getDataSources(): array
	{
		return [
				'method' => 'GET',
				'path'   => 'data-sources',
				'params' => [
						'limit'        => $this->params->limit(),
						'marker'       => $this->params->marker()
				]
		];
	}
	
	public function patchDataSource(): array
	{
		return [
				'method'  => 'PUT',
				'path'    => 'data-sources/{id}',
				'params'  => [
						'id'				=> $this->params->urlId('datasource'),
						'isPublic'			=> $this->params->isPublic(),
						'isProtected'		=> $this->params->isProtected(),
						'name'				=> $this->params->dataSourceName(),
						'description'		=> $this->params->dataSourceDescription(),
				],
		];
	}
	
	///////----------------- cluster-template -------------------///////////
	public function postClusterTemplate(): array
	{
		return [
				'path'    => 'cluster-templates',
				'method'  => 'POST',
				'params'  => [
						'pluginName'            => $this->params->pluginName(),
						'hadoopVersion'           => $this->params->hadoopVersion(),
						'nodeGroups'			=> $this->params->nodeGroups(),
						'name'     			=> $this->isRequired($this->params->name('cluster-template'))
				]
		];
	}
	public function getClusterTemplates(): array
	{
		return [
				'method' => 'GET',
				'path'   => 'cluster-templates',
				'params' => [
						'limit'        => $this->params->limit(),
						'marker'       => $this->params->marker(),
						'sort_by'	   => $this->params->sortkey(),
				]
		];
	}
	
	public function getClusterTemplate(): array
	{
		return [
				'method' => 'GET',
				'path'   => 'cluster-templates/{id}',
				'params' => [
						'id'           => $this->params->urlId('cluster-templates')
				]
		];
	}
	
	public function deleteClusterTemplate(): array
	{
		return [
				'method' => 'DELETE',
				'path'   => 'cluster-templates/{id}',
				'params' => ['id' => $this->params->urlId('cluster-template')],
		];
	}
	
	public function putClusterTemplate(): array
	{
		return [
				'method'  => 'PUT',
				'path'    => 'cluster-templates/{id}',
				'params'  => [
						'id'   		=> $this->params->urlId('cluster-template'),
						'name' 		=> $this->params->name('cluster-template'),
						'isPublic' 	=> $this->params->isPublic(),
						'pluginName'=> $this->notRequired($this->params->pluginName()),
						'hadoopVersion' => $this->notRequired($this->params->hadoopVersion())
				]
		];
	}
}

?>