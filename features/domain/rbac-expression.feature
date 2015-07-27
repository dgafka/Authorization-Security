# RBAC is about roles in the system. If user role has enough permission he is authorized
Feature: As user I want to manage role based access control

  Background: Users
    Given users with roles:
      | user     | role             |
      | 1        | Admin            |
      | 2        | User             |
      | 3        | User,Moderator   |

  Scenario Outline: As user I want to modify resource
    Given "role" security
    And is user with id <user>
    When user check <expression>
    Then he should be allowed <result>

  Examples:
    |user| expression                               | result |
    | 1  | "user.hasRole('User')"                   |    0   |
    | 1  | "user.hasRole('Admin')"                  |    1   |
    | 2  | "user.hasRole('Admin')"                  |    0   |
    | 2  | "user.hasRole('Rambo')"                  |    0   |
    | 2  | "user.hasRole('User')"                   |    1   |
    | 3  | "user.hasRole('Rambo')"                  |    0   |
    | 3  | "user.hasRole('Moderator')"              |    1   |
    | 1  | "user.containsRole(['Rambo', 'Admin'])"  |    1   |
    | 2  | "user.containsRole(['Rambo', 'Admin'])"  |    0   |
    | 3  | "user.containsRole(['User', 'Admin'])"   |    1   |
