<?php

/**
 * Simple Machines Forum (SMF)
 *
 * @package SMF
 * @author Simple Machines https://www.simplemachines.org
 * @copyright 2024 Simple Machines and individual contributors
 * @license https://www.simplemachines.org/about/smf/license.php BSD
 *
 * @version 3.0 Alpha 1
 */

namespace SMF\MailAgent;

interface MailAgentInterface
{
	/**
	 * Checks if the requirements for the agent are available.
	 *
	 * @return bool True if the agent is supported, false otherwise.
	 */
	public function isSupported(): bool;

	/**
	 * Checks if the agent has been configured for usage.
	 *
	 * @return bool True if the agent is configured, false otherwise.
	 */
	public function isConfigured(): bool;

	/**
	 * Connects to the mail agent.  Not all agents will need to connect.
	 *
	 * @return bool Whether or not the agent method was connected to.
	 */
	public function connect(): bool;

	/**
	 * Sends the email via the agent
	 *
	 * @param string $to
	 * @param string $subject
	 * @param string $message Message should be formatted with html/plain text.
	 * @param string $headers Any additional headers.
	 */
	public function send(string $to, string $subject, string $message, string $headers): bool;

	/**
	 * Disconnects to the mail agent.  Not all agents will need to disconnect.
	 *
	 * @return bool Whether or not the agent method was connected to.
	 */
	public function disconnect(): bool;

	/**
	 * Gets the Version of the Agent.
	 *
	 * @return string the value of $key.
	 */
	public function getVersion(): string;

	/**
	 * Gets the class identifier of the current agent implementation.
	 *
	 * @return string the unique identifier for the current class implementation.
	 */
	public function getImplementationClassKeyName(): string;

	/**
	 * Provides additional settings for the settings page.
	 *
	 * @param array $config_vars Current configuration settings, passed by reference.  Append to add more.
	 */
	public function agentSettings(array &$config_vars): void;
}

?>