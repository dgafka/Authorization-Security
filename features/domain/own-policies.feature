# own policies used with expressions
Feature: As user I want to manage own policies

  Background: Users
    Given users with level:
      | user     | level            |
      | 1        | 0                |
      | 2        | 4                |
      | 3        | 10               |

  Scenario Outline: As user I want to modify resource
    Given "lattice" security
    And is user with id <user>
    And security contains own policies
    When user check <expression> and <policy>
    Then he should be allowed <result>

  Examples:
    |user| expression          |policy                           | result |
    | 1  | "user.id == user.id"|"isSuperUser"                    |    1   |
    | 1  | "user.id == user.id"|"isLocalHost"                    |    0   |
    | 2  | "user.id == user.id"|"isSuperUser,isLocalHost"       |    0   |
    | 2  | "user.id == user.id"|"isMonday"                       |    1   |
    | 2  | "user.id == user.id"|"userLevelHigherThan5"           |    0   |
    | 3  | "user.id == user.id"|"userLevelHigherThan5"           |    1   |
    | 3  | "user.id == user.id"|"isMonday,userLevelHigherThan5" |    1   |
