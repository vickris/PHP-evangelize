<?php
class GithubApi
{
    protected $username;
    public function __construct($username)
    {
        $this->username = $username;
    }

    public function getRepos()
    {
        $url = "https://api.github.com/users/{$this->username}/repos";
        $response = file_get_contents($url,
            false,
            self::getStreamContext());
        $decoded = json_decode($response, true);
        $number = count($decoded);
        return $number;
    }

    public static function getStreamContext()
    {
        // This will solve the failed to open stream: HTTP request failed!
        // which happens when the  file being returned by file_get_contents
        // is too large
        $options  = [
                'http' => [
                    'user_agent' => 'CV/1.0.0'
                ]
            ];
        return stream_context_create($options);
    }

}
