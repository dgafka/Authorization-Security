# Own expression used in expressions
Feature: As user I want to manage own expressions

Background: Users
  Given users with level:
    | user     | level            |
    | 1        | 0                |
    | 2        | 4                |
    | 3        | 10               |

Scenario Outline: As user I want to modify resource
  Given "lattice" security
  And is user with id <user>
  And expression language contains own functions
  When user check <expression>
  Then he should be allowed <result>

Examples:
  |user| expression                                           | result |
  | 1  | "isLocalHost()"                                      |    1   |
  | 1  | "isSuperPlayer(user)"                                |    0   |
  | 2  | "isLocalHost() and isSuperPlayer(user)"              |    0   |
  | 2  | "isStringLower('lower')"                             |    1   |
  | 2  | "isStringLower('HIGHER')"                            |    0   |
  | 3  | "isEqualTo10(2, 4)"                                  |    0   |
  | 3  | "isEqualTo10(5, 2)"                                  |    1   |
