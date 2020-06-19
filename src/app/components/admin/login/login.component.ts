import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl } from '@angular/forms';
import { AuthenticationService } from '../../../services/authentication.service';
import { TokenStorageService } from '../../shared/security/token-storage.service';
import { ActivatedRoute, Router } from '@angular/router';
import { User } from '../../../domain/user.model';

@Component({
  selector: 'login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  public loginForm: FormGroup;
  errorMessage = '';
  private returnUrl: string;

  constructor(private authenticationService: AuthenticationService,
    private router: Router,
    private tokenStorageService: TokenStorageService,
    private activatedRoute: ActivatedRoute) { }

  ngOnInit() {
    if (this.tokenStorageService.getToken()) {
      this.tokenStorageService.signOut();
    }
    this.activatedRoute.queryParams.subscribe(params => {
      this.returnUrl = params['returnUrl'];
    });
    this.loginForm = new FormGroup({
      username: new FormControl(),
      password: new FormControl()
   });
  }

  onSubmit() {
    const userData: any = {
      username: this.loginForm.get('username').value,
      password: this.loginForm.get('password').value,
    };
    this.authenticationService.login(userData)
      .subscribe(
        data => {
          const user: User = data.user;
          this.tokenStorageService.saveToken(data.jwt);
          this.tokenStorageService.saveUser(user);
          if (this.returnUrl) {
            this.router.navigate([`/${this.returnUrl}`]);
          } else {
            this.router.navigate([`/admin`]);
          }
        },
        err => {
          this.errorMessage = err.error.message;
        }
      );
  }

  reloadPage() {
    window.location.reload();
  }
}