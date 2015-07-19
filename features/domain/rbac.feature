# RBAC is about roles in the system. If user role has enough permission he is authorized
Feature: As user I want to manage resource with role based access control

  Background: Users
    Given there are resource:
      | resource |
      | 1        |
      | 2        |
      | 3        |
    And roles:
      | user     |
      | Admin    |
      | User     |
    And role permissions:
      | resource | role       |
      | 1        | Admin      |
      | 2        | User       |

  Scenario Outline: As user I want to modify resource
    Given "rbac" permissions
    And is resource with id <resource>
    When user with role <role> modify resource
    Then he should be allowed <result>

  Examples:
    | resource | role | result |
    |        1 |    1 |      1 |
    |        1 |    2 |      0 |
    |        2 |    1 |      1 |
    |        2 |    2 |      1 |
    |        3 |    1 |      0 |
    |        3 |    2 |      0 |
