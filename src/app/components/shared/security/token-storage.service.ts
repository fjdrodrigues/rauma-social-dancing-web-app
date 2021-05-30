import { Injectable } from '@angular/core';
import { User } from '../../../domain/user.interface';
import { Subject, Observable } from 'rxjs';

const TOKEN_KEY = 'auth-token';
const USER_KEY = 'auth-user';

@Injectable({
  providedIn: 'root'
})
export class TokenStorageService {

  private authenticationState = new Subject<any>();

  constructor() { }

  signOut() {
    window.sessionStorage.clear();
    this.authenticationState.next(null);
  }

  public saveToken(token: string) {
    window.sessionStorage.removeItem(TOKEN_KEY);
    window.sessionStorage.setItem(TOKEN_KEY, token);
  }

  public getToken(): string {
    return sessionStorage.getItem(TOKEN_KEY);
  }

  public saveUser(user: User) {
    window.sessionStorage.removeItem(USER_KEY);
    window.sessionStorage.setItem(USER_KEY, JSON.stringify(user));
    this.authenticationState.next(user);
  }

  public getUser(): User {
    return JSON.parse(sessionStorage.getItem(USER_KEY));
  }

  public isAuthenticated(): boolean {
    return sessionStorage.getItem(TOKEN_KEY) != null && sessionStorage.getItem(USER_KEY) != null;
  }

  getAuthenticationState(): Observable<any> {
    return this.authenticationState.asObservable();
  }

  public hasAnyRole(roles: string[]): boolean {
    const user: User = JSON.parse(sessionStorage.getItem(USER_KEY));
    if (user) {
      return roles.includes(user.userType);
    } else {
      return false;
    }
  }
}