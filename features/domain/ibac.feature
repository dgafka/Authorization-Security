#IBAC is about permissions to resource for user
Feature: I want to manage resource with identity based access control

Background:
  Given users and permissions:
    | resource | user |
    | 1,2      | 1    |
    | 2        | 2    |
    | 3        | 3    |
    |          | 4    |

Scenario Outline: As user I want to modify resource
  Given "ibac" security
  And is user with id <user>
  And is resource with id <resource>
  When user tries to modify
  Then he should be allowed <result>

Examples:
  | resource | user | result |
  |        1 |    1 |      1 |
  |        1 |    2 |      0 |
  |        2 |    1 |      1 |
  |        2 |    2 |      1 |
  |        3 |    1 |      0 |
  |        3 |    2 |      0 |


