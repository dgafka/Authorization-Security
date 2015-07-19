#IBAC is about permissions to resource for user
Feature: I want to manage resource with identity based access control

  Background:
    Given there are resource:
      | resource |
      | 1        |
      | 2        |
      | 3        |
    And users:
      | user     |
      | 1        |
      | 2        |
    And permissions:
      | resource | user |
      | 1        | 1    |
      | 2        | 1    |
      | 2        | 2    |

  Scenario Outline: As user I want to modify resource
    Given "ibac" permissions
    And is resource with id <resource>
    When user with id <user> modify resource
    Then he should be allowed <result>

  Examples:
    | resource | user | result |
    |        1 |    1 |      1 |
    |        1 |    2 |      0 |
    |        2 |    1 |      1 |
    |        2 |    2 |      1 |
    |        3 |    1 |      0 |
    |        3 |    2 |      0 |


