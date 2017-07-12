<?php declare(strict_types=1);

namespace OpenStack\DataProcessing\v1;

use OpenStack\Common\Api\AbstractParams;

class Params extends AbstractParams
{
public function urlId(string $type): array
	{
		return array_merge(parent::idPath($type), [
				'required'   => true,
				'location'   => self::URL,
				'documented' => false
		]);
	}

	public function url(): array
	{
		return [
				'type'        => self::STRING_TYPE,
				'required'    => true,
				'sentAs'      => 'url',
		];
	}

	public function description(): array
	{
		return [
				'type'        => self::STRING_TYPE,
				'required'    => false,
				'sentAs'      => 'description',
		];
	}

	public function isPublic(): array
	{
		return [
				'type'        => self::BOOL_TYPE,
				'sentAs'      => 'is_public',
				'location'    => self::JSON

		];
	}

	public function pluginName(): array
	{
		return [
				'type'        => self::STRING_TYPE,
				'required'    => true,
				'sentAs'      => 'plugin_name',
				'description' => 'The plugin name of cluster'
		];
	}

	public function hadoopVersion(): array
	{
		return [
				'type'        => self::STRING_TYPE,
				'required'    => true,
				'sentAs'      => 'hadoop_version',
				'description' => 'The hadoopversion of cluster'
		];
	}

	public function clusterTemplateId(): array
	{
		return [
				'type'        => self::STRING_TYPE,
				'required'    => true,
				'sentAs'      => 'cluster_template_id',
				'description' => 'The cluster template id'
		];
	}

	public function defaultImageId(): array
	{
		return [
				'type'        => self::STRING_TYPE,
				'required'    => true,
				'sentAs'      => 'default_image_id',
				'description' => 'The default image id'
		];
	}

	public function userKeypairId(): array
	{
		return [
				'type'        => self::STRING_TYPE,
				'required'    => true,
				'sentAs'      => 'user_keypair_id',
				'description' => 'The user keypair id'
		];
	}

	public function neutronManagementNetwork(): array
	{
		return [
				'type'        => self::STRING_TYPE,
				'required'    => true,
				'sentAs'      => 'neutron_management_network',
				'description' => 'The neutron management network'
		];
	}

	public function count(): array
	{
		return [
				'type'        => self::INT_TYPE,
				'required'    => true,
				'sentAs'      => 'count',
				'description' => 'Numbers of cluster to be created'
		];
	}

	public function clusterConfigs(): array
	{
		return [
				'type'        => self::OBJECT_TYPE,
				'required'    => false,
				'sentAs'      => 'cluster_configs',
				'description' => 'Configuration of clusters to be created'
		];
	}

	public function addNodeGroups(): array
	{
		return [
				'type'        => self::ARRAY_TYPE,
				'sentAs'      => 'add_node_groups',
				'items'       => [
						'type'       => self::OBJECT_TYPE,
						'properties' => [
								'count'     => [
										'type'        => self::INTEGER_TYPE,
								],
								'name' => [
										'type'        => self::STRING_TYPE,
								],
								'nodeGroupTemplateId' => [
										'type'        => self::STRING_TYPE,
										'sentAs'	  => 'node_group_template_id'
								]
						]
				],
		];
	}
	public function nodeGroupTemplateId(): array
	{
		return [
				'type'        => self::STRING_TYPE,
				'sentAs'      => 'node_group_template_id'
		];
	}

	public function resizeNodeGroups(): array
	{
		return [
				'type'        => self::ARRAY_TYPE,
				'sentAs'      => 'resize_node_groups',
				'items'       => [
						'type'       => self::OBJECT_TYPE,
						'properties' => [
								'count'     => [
										'type'        => self::INTEGER_TYPE,
								],
								'name' => [
										'type'        => self::STRING_TYPE,
								]
						]
				],
		];
	}
//-------------------------------------------------------------------

	public function dataSourceType(): array
	{
		return [
				'type'        => self::STRING_TYPE,
				'required'    => true,
				'sentAs'      => 'type',
				'description' => 'The type of the data source object'
		];
	}

	public function dataSourceName(): array
	{
		return [
				'type'        => self::STRING_TYPE,
				'required'    => true,
				'sentAs'      => 'name',
				'description' => 'The name of the data source object'
		];
	}


	//-----------------james edited for cluster template ---------------------//
	public function nodeGroups(): array
	{
		return	[
					'type'        => self::ARRAY_TYPE,
					'sentAs'	  => 'node_groups',
					'required'	  => false,
					'description' => 'List of nodeGroups',
					'items'       => [
						'type'       => self::OBJECT_TYPE,
						'properties' => [
							'name'         => $this->name('node-group-template'),
							'count'		   => $this->count(),
							'nodeGroupTemplateId' => $this->nodeGroupTemplateId()
						]
					]
		];
	}

	public function shares(): array
	{
		return	[
					'type'			=> self::ARRAY_TYPE,
					'desciption'	=> 'shares',
					'required'		=> false
		];
	}

	public function domainName(): array
	{
		return	[
					'type'			=> self::STRING_TYPE,
					'required'		=> false,
					'sentAs'		=> 'domain_name'
		];
	}

	public function antiAffinity(): array
	{
		return	[
					'type'			=> self::ARRAY_TYPE,
					'required'		=> false,
					'sentAs'		=> 'anti_affinity'
		];
	}

	//--------start------nodegrouptemplate-------------------//
	public function flavorId(): array
	{
		return [
			'type'        => self::STRING_TYPE,
			'required'    => true,
			'sentAs'      => 'flavor_id',
			'description' => 'flavor id of node group template to be created'
		];
	}

	public function nodeProcesses(): array
	{
		return [
			'type'        => self::ARRAY_TYPE,
			'required'    => true,
			'sentAs'      => 'node_processes',
			'description' => '	The list of the processes performed by the node.'
		];
	}



	public function availabilityZone(): array
	{
		return [
			'type'        => self::STRING_TYPE,
			'required'    => false,
			'sentAs'      => 'availability_zone',
			'description' => 'The availability of the node in the cluster.'
		];
	}

	public function imageId(): array
	{
		return [
			'type'        => self::STRING_TYPE,
			'required'    => false,
			'sentAs'      => 'image_id',
			'description' => 'The UUID of the image'
		];
	}

	public function floatingIpPool(): array
	{
		return [
			'type'        => self::STRING_TYPE,
			'required'    => false,
			'sentAs'      => 'floating_ip_pool',
			'description' => 'The UUID of the pool in the template'
		];
	}

	public function useAutoconfig(): array
	{
		return [
			'type'        => self::BOOL_TYPE,
			'required'    => false,
			'sentAs'      => 'use_autoconfig',
			'description' => 'If set to true, the cluster is auto configured.'
		];
	}

	public function isProxyGateway(): array
	{
		return [
			'type'        => self::BOOL_TYPE,
			'required'    => false,
			'sentAs'      => 'is_proxy_gateway',
			'description' => 'If set to true, the node is the proxy gateway.'
		];
	}

	public function isProtected(): array
	{
		return [
			'type'        => self::BOOL_TYPE,
			'required'    => false,
			'sentAs'      => 'is_protected',
			'description' => 'If set to true, the object is protected.'
		];
	}
	//--------end--------nodegrouptemplate-------------------//

	//--------------start----job bianry------------------//

	public function extra(): array
	{
		return [
				'type'        => self::OBJECT_TYPE,
				'required'    => true,
				'properties' => [
						'password'     => [
								'type'        => self::STRING_TYPE,
						],
						'user' => [
								'type'        => self::STRING_TYPE,
						]
				]
		];
	}

	//--------------end----job bianry------------------//

	public function version(): array
	{
	 return [
			 'type'        => self::STRING_TYPE,
			 'required'    => true,
			 'sentAs'      => 'versions',
			 'description' => 'The version of plugin'
	 ];
 }

}

?>
