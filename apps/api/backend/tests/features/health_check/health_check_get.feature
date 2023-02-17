Feature: Api status
  In order to know the server is up and running
  As a health check
  I want to check the api status

  Scenario: Check the api status
    Given I am on "/api/health-check"
    And the response content should be:
    """
    {
      "api-backend": "ok"
    }
    """
    Then the response status code should be 200