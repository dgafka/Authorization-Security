# Testing own functions
Feature: As user I want to manage resource with role based access control

  Background: Users
    Given users with level:
      | user     | level            |
      | 1        | 0                |
      | 2        | 4                |
      | 3        | 10               |

  Scenario Outline: As user I want to modify resource
    Given "lattice" security
    And is user with id <user>
    When user check <expression>
    Then he should be allowed <result>

  Examples:
    |user| expression                                           | result |
    | 1  | "user.permission.level < 5"                          |    1   |
    | 1  | "user.permission.level == 0"                         |    1   |
    | 2  | "user.permission.level > 4"                          |    0   |
    | 2  | "user.permission.level >= 4"                         |    1   |
    | 2  | "user.permission.level < 0"                          |    0   |
    | 3  | "user.permission.level > 5 and user.id == 2"         |    0   |
    | 3  | "user.permission.level == 10"                        |    1   |
    | 3  | "user.id == 3"                                       |    1   |
    | 3  | "user.id == 4 or user.permission.level > 9"          |    1   |